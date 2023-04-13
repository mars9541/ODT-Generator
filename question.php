<?php

$jsonFile = './questions.json';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $jsonData = json_decode(file_get_contents('php://input'), true);
    if (sizeof($jsonData)) {
        $saveAry = array();
        $id = 0;
        foreach ($jsonData['data'] as $rowIndex => $parent) {
            if (!$parent['question']) {
                continue;
            }

            $id++;
            // $type = 'radio';
            if ($rowIndex == sizeof($jsonData['data']) * 1 - 1) {
                $type = 'text';
            }
            $saveAry[] = array(
                'id' => $id,
                'pid' => 0,
                'subid' => 0,
                'isleaf' => 0,
                'type' => $parent['type'],
                'name' => $parent['name'],
                'question' => $parent['question'],
            );
            if (isset($parent['subRow'])) {
                $pid = $id;
                foreach ($parent['subRow'] as $subRow) {
                    if (!$subRow['sub_question']) {
                        continue;
                    }
                    $id++;
                    $saveAry[] = array(
                        'id' => $id,
                        'pid' => $pid,
                        'subid' => 0,
                        'isleaf' => 1,
                        'type' => $subRow['type'],
                        'name' => $subRow['name'],
                        'question' => $subRow['sub_question'],
                    );

                    if (isset($subRow['childRow'])) {
                        $subid = $id;
                        foreach ($subRow['childRow'] as $childRow) {
                            if (!$childRow['child_question']) {
                                continue;
                            }

                            $id++;
                            $saveAry[] = array(
                                'id' => $id,
                                'pid' => $pid,
                                'subid' => $subid,
                                'isleaf' => 2,
                                'type' => $childRow['type'],
                                'name' => $childRow['name'],
                                'question' => $childRow['child_question'],
                            );

                        }
                    }
                }
            }
        }
        // echo '<script type="text/javascript"> alert("Saved successfully."); </script>';
    }
    file_put_contents($jsonFile, json_encode($saveAry));
}

$jsonContent = file_get_contents($jsonFile);
/* Select queries return a resultset */
if (sizeof(json_decode($jsonContent))) {
    $json = array();
    $rowIndex = 0;
    foreach (json_decode($jsonContent) as $row) {
        if ($row->pid) {
            if ($row->isleaf == 1) {
                if (!isset($json[$row->pid]['subRow'])) {
                    $json[$row->pid]['subRow'] = array();
                }
                $json[$row->pid * 1]['subRow'][$row->id] = array(
                    'sub_question' => $row->question,
                    'type' => $row->type,
                    'name' => $row->name,
                );
            }
            if ($row->isleaf == 2) {
                if (!isset($json[$row->pid]['subRow'][$row->subid]['childRow'])) {
                    $json[$row->pid]['subRow'][$row->subid]['childRow'] = array();
                }
                $json[$row->pid]['subRow'][$row->subid]['childRow'][] = array(
                    'child_question' => $row->question,
                    'type' => $row->type,
                    'name' => $row->name,
                );
            }
        } else {
            $json[$row->id]['question'] = $row->question;
            $json[$row->id]['type'] = $row->type;
            $json[$row->id]['name'] = $row->name;
        }
    }
    // print_r($json);exit;
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
                        // print_r($subRow);exit;
						$newSubRow[] = array(
							'childRow' => $newChildRow,
							'sub_question' => $subRow['sub_question'],
							'type' => $subRow['type'],
							'name' => $subRow['name']
						);
                    } else {
                        $newSubRow[] = $subRow;
                    }

                }
                $newParentRow['subRow'] = $newSubRow;
                $newParentRow['question'] = $parentRow['question'];
                $newParentRow['type'] = $parentRow['type'];
                $newParentRow['name'] = $parentRow['name'];
            } else {
                $newParentRow = $parentRow;
            }
            $newJson[] = $newParentRow;
        }
    }
    echo '<script>var jsonData = ' . json_encode($newJson) . '</script>';
}

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" ng-app="MyApp">
	<head>
		<title>Form2Json</title>
		<meta name="keywords" content="json,doc" />
		<meta name="Resource-type" content="Document" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

		<!-- <link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css" /> -->
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
		<script src="./js/angular.min.js"></script>
		<script src="./js/jquery-1.11.1.min.js"></script>
		<script src="./js/index.js"></script>

		<style>
			.thead {
				font-weight: bold;
				height: 38px;
				vertical-align: center;
				border: 1px solid #ddd;
				padding-top: 8px;
			}
			.tbody {
				border: 1px solid #ddd;
				padding: 8px;
			}
			.padding-left-50 {
				padding-left: 50px;
			}
		</style>
	</head>
	<body ng-controller="MainCtrl">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-8">
					<div class="row">
						<div class="form-group">
							<div class="col-sm-6 thead">Question</div>
							<div class="col-sm-2 thead">Type</div>
							<div class="col-sm-2 thead">Name</div>
							<div class="col-sm-2 thead">Actions</div>
						</div>
					</div>
					<div class="row" ng-if="jsonContent" ng-repeat="item in jsonContent track by $index">
						<div class="col-sm-6 tbody">
							<input type="text" class="form-control" ng-model="item.question" placeholder="Input Your Question" />
						</div>

						<div class="col-sm-2 tbody">
                            <select class="form-control" ng-model="item.type" ng-selected="item.type" ng-options="type as type for type in answerType"></select>
						</div>
                        <div class="col-sm-2 tbody">
                            <input type="text" class="form-control" ng-model="item.name" placeholder="Input name" />
                        </div>
						<div class="col-sm-2 tbody text-center">
							<button type="button" class="btn btn-default btn-secondary" ng-click="addSubQuestion($index)">
								<i class="glyphicon glyphicon-plus" title="Add New Sub Question"></i>
							</button>
							<button type="button" class="btn btn-default btn-secondary" ng-click="DeleteQuestion($index)">
								<i class="glyphicon glyphicon-trash" title="Delete Question"></i>
							</button>
						</div>

						<div class="col-sm-12 padding-left-50" ng-init="parentKey = $index">
							<div class="row" ng-if="item.subRow" ng-repeat="sub in item.subRow track by $index">
								<div class="col-sm-6 tbody">
									<input type="text" class="form-control" ng-model="sub.sub_question" placeholder="Input Your Question" />
								</div>
								<div class="col-sm-2 tbody">
									<select class="form-control" ng-model="sub.type" ng-selected="sub.type" ng-options="type as type for type in answerType"></select>
                                </div>
                                <div class="col-sm-2 tbody">
                                    <input type="text" class="form-control" ng-model="sub.name" placeholder="Input name" />
                                </div>
								<div class="col-sm-2 tbody text-center">
									<button type="button" class="btn btn-default btn-secondary" ng-click="addChildSubQuestion(parentKey, $index)">
										<i class="glyphicon glyphicon-plus" title="Add New Sub Question"></i>
									</button>
									<button type="button" class="btn btn-default btn-secondary" ng-click="DeleteSubQuestion(item, $index)">
										<i class="glyphicon glyphicon-trash" title="Delete Question"></i>
									</button>
								</div>
								<div class="col-sm-12 padding-left-50" ng-init="subKey = $index">
									<div class="row" ng-if="sub.childRow" ng-repeat="child in sub.childRow track by $index">
										<div class="col-sm-6 tbody">
											<input type="text" class="form-control" ng-model="child.child_question" placeholder="Input Your Question" />
										</div>
										<div class="col-sm-2 tbody">
											<select class="form-control" ng-model="child.type" ng-selected="child.type" ng-options="type as type for type in answerType"></select>
                                        </div>
                                        <div class="col-sm-2 tbody">
                                            <input type="text" class="form-control" ng-model="child.name" placeholder="Input name" />
                                        </div>
										<div class="col-sm-2 tbody text-center">
											<button type="button" class="btn btn-default btn-secondary" ng-click="deleteChildSubQuestion(parentKey, subKey, $index)">
												<i class="glyphicon glyphicon-trash" title="Delete Question"></i>
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group">
							<div class="col-sm-12 text-right" style="padding-top: 10px;">
								<button class="btn btn-primary" id="addrow" ng-click="addRow()">
									<i class="glyphicon glyphicon-plus"></i> Add Question</button>
								<button class="btn btn-primary" id="save"  ng-click="save()">
									<i class="glyphicon glyphicon-ok"></i> Save Questions</button>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="well jsonviewer">
						<pre ref="json" class="au-target" au-target-id="5">{{jsonContent | json}}</pre>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
