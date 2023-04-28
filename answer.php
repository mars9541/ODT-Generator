<?php

$jsonFile = './questions.json';
$jsonContent = file_get_contents($jsonFile);

$user_key = '@_@_1234';
$aAry = array();
$json = array();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $answerJsonFile = './answers.json';
    $rowCount = sizeof(json_decode($jsonContent));
    $saveAry = array();
    $rowId = 0;
    $user_key = 'user_1234';
    for ($i = 1; $i <= $rowCount; $i++) {
        if (isset($_POST['input_' . $i])) {
            $rowId++;
            $answer = $_POST['input_' . $i];
            $answerAry = explode('_@@@@_', $answer);
            if (sizeof($answerAry) > 1) {
                $answer = $answerAry[1];
            }
            $saveAry[] = array(
                'id' => $rowId,
                'user_key' => $user_key,
                'question_id' => $i,
                'answer' => $answer,
            );
            $aAry[$i] = $answer;
        }
    }

    file_put_contents($answerJsonFile, json_encode($saveAry));
    $docString = '';

    $newAry = array();
    $docContent = '<html>
        <body onLoad="document.forms[\'document_download\'].submit();" style="display:none;">
            <form action="demo_merge.php" method="post" name="document_download">';
    
    foreach (json_decode($jsonContent) as $row) {
        $newAry[$row->id] = array();

        if (isset($aAry[$row->id]) && $aAry[$row->id]) {
            $docContent .= '<input type="hidden" name="' . $row->name . '" value="' . $aAry[$row->id] . '" />';
        }
    }
    $docContent .= '</form> 
        </body>
    </html>';
    
    exit($docContent);
}
if (sizeof(json_decode($jsonContent))) {
    $rowIndex = 0;
    $subid = 0;
    foreach (json_decode($jsonContent) as $row) {
        if ($row->pid) {
            if ($row->isleaf == 1) {
                if (!isset($json[$row->pid]['subRow'])) {
                    $json[$row->pid]['subRow'] = array();
                }
                $json[$row->pid * 1]['subRow'][$row->id] = array(
                    'sub_question' => $row->question,
                    'type' => $row->type,
                    'id' => $row->id,
                    'isleaf' => $row->isleaf,
                    'pid' => $row->pid,
                    'subid' => $row->subid,
                );
            }
            if ($row->isleaf == 2) {
                if (!isset($json[$row->pid]['subRow'][$row->subid]['childRow'])) {
                    $json[$row->pid]['subRow'][$row->subid]['childRow'] = array();
                }
                $json[$row->pid]['subRow'][$row->subid]['childRow'][] = array(
                    'child_question' => $row->question,
                    'type' => $row->type,
                    'id' => $row->id,
                    'isleaf' => $row->isleaf,
                    'pid' => $row->pid,
                    'subid' => $row->subid,
                );
            }
        } else {
            $json[$row->id]['question'] = $row->question;
            $json[$row->id]['type'] = $row->type;
            $json[$row->id]['id'] = $row->id;
            $json[$row->id]['isleaf'] = $row->isleaf;
            $json[$row->id]['pid'] = $row->pid;
            $json[$row->id]['subid'] = $row->subid;
        }
    }
    $newJson = array();
    if (sizeof($json)) {
        foreach ($json as $parentRow) {
            $newParentRow = array();
            if (isset($parentRow['subRow'])) {
                $newSubRow = array();
                foreach ($parentRow['subRow'] as $subRow) {
                    $newChildRow = array();
                    if (isset($subRow['childRow'])) {
                        foreach ($subRow['childRow'] as $childRow) {
                            $newChildRow[] = $childRow;
                        }
                        $newSubRow[] = array(
                            'childRow' => $newChildRow,
                            'sub_question' => $subRow['sub_question'],
                            'type' => $subRow['type'],
                            'id' => $subRow['id'],
                            'pid' => $subRow['pid'],
                            'subid' => $subRow['subid'],
                            'isleaf' => $subRow['isleaf'],
                        );
                    } else {
                        $newSubRow[] = $subRow;
                    }
                }
                $newParentRow['subRow'] = $newSubRow;
                $newParentRow['question'] = $parentRow['question'];
                $newParentRow['type'] = $parentRow['type'];
                $newParentRow['id'] = $parentRow['id'];
                $newParentRow['pid'] = $parentRow['pid'];
                $newParentRow['subid'] = $parentRow['subid'];
                $newParentRow['isleaf'] = $parentRow['isleaf'];
            } else {
                $newParentRow = $parentRow;
            }
            $newJson[] = $newParentRow;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en-US" class=" no-touchevents">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
	<meta name="viewport" id="vp" content="initial-scale=1.0,user-scalable=no,maximum-scale=1" media="(device-height: 568px)">
	<meta name="description" content="Type Form">
	<link rel="stylesheet" type="text/css" media="screen" href="./css/white.css">
	<title>Light Form</title>

	<style>
		.background{
			background: url(./imgs/back1.jpg) no-repeat center center fixed;
			background-size: cover;
			width: 100%;
			height: 100%;
			position: fixed;
			display: table;
			top: 0;
			opacity: .2;
		}
		.hide-item {
			display: none;
		}
		.always-hide-item {
			display: none;
		}
		.lf-progress-box {
			display: none;
		}
		.subRow {
			margin-left: 30px;
		}
	</style>

	<script type="text/javascript" src="./js/jquery-1.11.1.min.js"></script>
	<script src="./js/tinymce.min.js"></script>
	<script src="./js/FileSaver.js"></script>
	<script src="./js/html-docx.js"></script>

    <script type="text/javascript">
		function setSubQuestion (val) {
            if (val.value) {
                var values = val.value.split("_@@@@_");
                var alwaysHideItemCount = $('.always-hide-' + values[0]).length;
                if ((values[1]).toLowerCase() == "yes") {
                    $(".subrow-" + values[0]).each(function() {
                        if (!$(this).hasClass('always-hide-item-' + values[0])) {
                            $(this).css("display", "block");
                            $(this).removeClass("hide-item");
                        }
                    });
                    $(".child-" + values[0]).each(function() {
                        if (!$(this).hasClass('always-hide-item-' + values[0])) {
                            $(this).css("display", "block");
                            $(this).removeClass("hide-item");
                        }
                    });
                }
                if ((values[1]).toLowerCase() == "no") {
                    $(".subrow-" + values[0]).each(function() {
                        $(this).css("display", "none");
                        $(this).addClass("hide-item");
                    });
                    var rowCount = 0;
                    baseJson.forEach(function(e) {
                        if (e.pid == values[0]) {
                            rowCount ++;
                        }
                    });
                }
            }

		}
		function downloadWord1() {
			tinymce.init({
			selector: "#content",
			plugins: [
				"advlist autolink lists link image charmap print preview anchor",
				"searchreplace visualblocks code fullscreen fullpage",
				"insertdatetime media table contextmenu paste"
			],
			toolbar: "insertfile undo redo | styleselect | bold italic | " +
				"alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | " +
				"link image"
			});
			var contentDocument = tinymce.get("content").getDoc();
			var content = "<!DOCTYPE html>" + contentDocument.documentElement.outerHTML;
			var converted = htmlDocx.asBlob(content);

			saveAs(converted, "info.docx");

			var link = document.createElement("a");
			link.href = URL.createObjectURL(converted);
			link.download = "info.docx";
		}

		function findIndex(value, isSelected) {
			var select_key = 0;
			for (var i=0; i < baseJson.length; i++) {
				if (baseJson[i].question === value) {
					select_key = baseJson[i].id;
					var content_element = $('#lf-field-' + select_key).find('.lf-content');
					if (isSelected) {
						if ($('.lf-li-choice-1_' + select_key).next().is('div')) {
							$('.lf-li-choice-1_' + select_key).next('div').show();
						} else {
							if (content_element[0])
								$('.lf-li-choice-1_' + select_key)[0].after(content_element[0])
						}
					} else {
						$('.lf-li-choice-1_' + select_key).next('div').hide();
					}
				}
			}
        }
        
        function downloadDoc(data) {
            var myWindow = window.open("", "ContentWindow");
            myWindow.document.write(data);
            myWindow.document.forms["document_download"].submit();
        }
	</script>

</head>

<body id="content1">
	<div id="lastform" class="lastform"></div>
	<div class="background"></div>
	<div id="content">

	</div>
	<?php
echo '<script>var data = ' . json_encode($newJson) . '</script>';
echo '<script>var baseJson = ' . ($jsonContent) . '</script>';
?>
	<script src="./js/answer.js"></script>
	<script type="text/javascript" src="./js/lastform-public.min.js"></script>
</body>
</html>