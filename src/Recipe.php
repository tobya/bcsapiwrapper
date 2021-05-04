<?php


namespace Bcsapi;


class Recipe extends BaseApi
{


    public function CourseBooklets($CourseID, $Week = '-1')
    {
        return array('error' => 'CourseBooklets method no longer valid');
    }

    public function BookletsByPath($PathID, $Week = '-1')
    {


        if ($Week == -1) {
            $apipath = '/{apikey}/lists/{pathid}/booklets';
            $APIFields = ['{pathid}' => $PathID];
        } else {
            $apipath = '/{apikey}/lists/{pathid}/booklets/week/{bookletweek}';
            $APIFields = ['{pathid}' => $PathID,
                '{bookletweek}' => $Week];
        }
        return $this->CallAPI($apipath, $APIFields);

    }

    public function RecipeSearch($SearchString)
    {
        $apipath = '/{apikey}/search/paths/{searchstring}';
        $APIFields = ['{searchstring}' => $SearchString];
        return $this->CallAPI($apipath, $APIFields);
    }

    public function RecipeSearchwithImages($SearchString)
    {
        $apipath = '/{apikey}/search/paths/{searchstring}';
        $APIFields = ['{searchstring}' => $SearchString];
        $RecipeList = $this->CallAPI($apipath, $APIFields);
        foreach ($RecipeList['recipes'] as $key => $R) {
            $Rids[] = $R['VersionID'];

        }
        $strList = implode(',', $Rids);
        $Images = $this->RecipeList_Images($strList);
        //echo $strList;
        //print_r($Images);
        foreach ($Images['images'] as $key => $I) {
            $ImgCount = count($I);
            $RecipeList['recipes'][$key]['images'] = $I;
            $RecipeList['recipes'][$key]['images_count'] = $ImgCount;

        }
        return $RecipeList;
    }

    public function RecipeList_Images($RecipeIDList)
    {
        $apipath = '/{apikey}/images/lists/{recipeidlist}';
        $APIFields = ['{recipeidlist}' => $RecipeIDList];
        $RecipeImageList = $this->CallAPI($apipath, $APIFields);
        return $RecipeImageList;
    }

    public function RecipeLists_ForCourseSelection($Year, $CourseType)
    {
        $apipath = "/{apikey}/lists/preset/listforcourseselection/{courseyear}/{coursetype}";
        $APIFields = ['{coursetype}' => $CourseType, '{courseyear}' => $Year];
        return $this->CallAPI($apipath, $APIFields);
    }

    public function RecipeLists_SearchForCourseSelection($Year, $CourseType, $SearchString)
    {
        $apipath = "/{apikey}/lists/preset/listforcourseselection/{courseyear}/{coursetype}/{searchstring}";
        $APIFields = ['{coursetype}' => $CourseType, '{courseyear}' => $Year, '{searchstring}' => $SearchString];
        return $this->CallAPI($apipath, $APIFields);
    }

    public function RecipeSearch_ForStudent($SearchString, $MetaBookingID)
    {

        $apipath = '/{apikey}/search/forstudent/{metabookingid}/{searchstring}';
        $APIFields = ['{searchstring}' => $SearchString,
            '{metabookingid}' => $MetaBookingID];

        return $this->CallAPI($apipath, $APIFields);
    }

    public function RecipeInfo($RecipeGUID, $MetaBookingID = '000')
    {
        $apipath = '/{apikey}/recipe/infowithurls/{recipeguid}/{metabookingid}';
        $fields = ['{recipeguid}' => $RecipeGUID, '{metabookingid}' => $MetaBookingID];
        return $this->CallAPI($apipath, $fields);
    }

    public function RecipeInfowithImages($RecipeGUID, $MetaBookingID = '000')
    {
        $RecipeInfo = $this->RecipeInfo($RecipeGUID, $MetaBookingID);
        $apipath = '/{apikey}/images/list/{recipeid}';
        $APIFields = ['{recipeid}' => $RecipeInfo['recipe']['VersionID']];
        $RecipeImageList = $this->CallAPI($apipath, $APIFields);
        $RecipeInfo['images'] = $RecipeImageList['images'];
        return $RecipeInfo;
    }

    public function UpdateList($ListID, $Updates)
    {
        $apipath = '/{apikey}/lists/{listid}/set';
        $fields = ['{listid}' => $ListID];
        $PostData = $Updates;  //currently only CourseID is set.
        echo $apipath;
        print_r($PostData);
        return $this->CallAPI($apipath, $fields, $PostData);

    }

    public function PathInfoByPath($Path)
    {
        $apipath = '/{apikey}/lists/searchone/{listsearch}';
        $fields = ['{listsearch}' => $Path];

        return $this->CallAPI($apipath, $fields);
    }

    public function PathsByPath($Path)
    {
        $apipath = '/{apikey}/lists/bypath/{path}';
        $fields = ['{path}' => $Path];

        return $this->CallAPI($apipath, $fields);
    }

    public function PathsByCourse($CourseInfo, $Week, $Day, $AMPM)
    {
        $path = $this->CourseRecipePath($CourseInfo, $Week, $Day, $AMPM);

        if ($path != "") {

            return $this->PathsByPath($path);
        }
        return json_encode([]);
    }

    public function PathByPathID($PathID)
    {
        $apipath = '/{apikey}/lists/{listid}/full';
        $fields = ['{listid}' => $PathID];

        return $this->CallAPI($apipath, $fields);
    }

    public function RecipeList($PathID)
    {
        return $this->PathByPathID($PathID);
    }

//------------------------------------------------------------------------------------------


    function CourseRecipePath($CourseInfo, $Week, $Day, $AMPM)
    {

        if ($CourseInfo['CourseType'] == 1 || $CourseInfo['CourseType'] == 3) { // 12 week / long

            list($Year, $StartMonth) = explode(',', date('Y,M', strtotime($CourseInfo['FromDate'])));

            $path = "Lists\\Courses\\$Year\\12 Week $StartMonth%\\%Week $Week\\$Day%\\%$AMPM%";
            return $path;
        } else {
            return "";
        }
    }


    public function BrowsePath($Path)
    {
        $Browse = $this->PathsByPath($Path);

        $PathLevel = substr_count($Path, '\\');
        $NextPathLevel = $PathLevel + 1;
        //pprint_r($Browse);
        //exit;
        //

        $RetrievedPath = $Browse['path'];


        if ($RetrievedPath['RecipeCount'] > 0 && $Browse['paths_count'] == 0) {
            $ListInfo = $this->PathByPathID($p['PathID']);

            $Paths['path'] = $RetrievedPath;
            $Paths['recipes'] = $ListInfo['recipes'];
            return $Paths;
        }

        $Paths = ['parentpath' => $Path, 'parent' => $RetrievedPath, 'children' => [], 'children_count' => ($Browse['paths_count'] - 1)];

        foreach ($Browse['paths'] as $key => $p) {
            # code...


            if (substr_count($p['Path'], '\\') == $NextPathLevel) {

                $Paths['children'][] = $p;


                if ($Paths['parent']['RecipeCount'] > 0) {


                    $ListInfo = $this->PathByPathID($Paths['parent']['PathID']);

                    $Paths['recipes'] = $ListInfo['recipes'];

                }

                return $Paths;

            }

        }
    }
}

