<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Kanban Board</title>

    <!-- Bootstrap -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
    <style>
        [class*="col-"] {
            padding-top: 0px;
            padding-bottom: 0px;
        }
        .nopadding {
            padding:0px;
            margin: 4px;
        }
        .progress {
            margin-bottom: 0 !important;
        }
        .list-group-item-warning #state:after {
            font-family:'Glyphicons Halflings';
            content:"\e073";
        }
    </style>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="container-fluid">
    @foreach($repositories as $repository => $milestones)
        <h3>{{$repository}}</h3>
        @foreach($milestones as $key => $milestone)
        <div class="panel panel-primary">
            <div class="panel-heading">
                <p class="panel-title">
                    <a href="{{$milestone['url']}}">
                        {{$key}}
                        <span style="float: right" class="glyphicon glyphicon-new-window"/>
                    </a>
                </p>
            </div>
            <div class="panel-body small">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="list-group">

                            @foreach($milestone['queued'] as $item)
                                <a href="{{$item['url']}}" class="list-group-item list-group-item-danger">
                                    <span class="glyphicon glyphicon-question-sign"></span>
                                    {{$item['title']}}
                                    <span style="float: right" class="glyphicon glyphicon-new-window"/></a>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="list-group">
                            @foreach($milestone['active'] as $item)
                                <a href="{{$item['url']}}" class="list-group-item list-group-item-warninglist-group-item-info">
                                    <img class="img-rounded" src="{{$item['assignee']}}" width="16" height="16" border="0"/>&nbsp;
                                    <em><small>{{$item['title']}}</small></em>
                                    <span id="state" class="glyphicon"></span>
                                    <span style="float: right" class="glyphicon glyphicon-new-window"/>
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="list-group">
                            @foreach($milestone['completed'] as $item)
                                <a href="{{$item['url']}}" class="list-group-item list-group-item-success">
                                    @isset($item['assignee'])
                                        <img class="img-rounded" src="{{$item['assignee']}}" width="16" height="16" border="0"/>&nbsp;
                                    @endisset
                                    <s>{{$item['title']}}</s>
                                    <span style="float: right" class="glyphicon glyphicon-new-window"/>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer small">
                <div class="progress">
                    <div class="progress-bar" role="progressbar" aria-valuenow="{{$milestone['progress']['percent']}}" aria-valuemin="0" aria-valuemax="100" style="min-width: 2em; width: {{$milestone['progress']['percent']}}%;">{{$milestone['progress']['percent']}}%</div>
                </div>
            </div>
        </div>
        @endforeach
    @endforeach
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="{{asset('js/bootstrap.min.js')}}"></script>
</body>
</html>