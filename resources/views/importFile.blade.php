<html lang="en">

<head>
    <title>Laravel 5.5 - import export data into excel and csv using maatwebsite </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" >

</head>
<body>

<div class="container">
    <div class="panel panel-primary">
        <div class="panel-heading">Laravel 5.5 - import export data into excel and csv using maatwebsite </div>
        <div class="panel-body">

            {!! Form::open(array('route' => 'importFile','method'=>'POST','files'=>'true')) !!}

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        {!! Form::label('imported_file','Select File to Import:',['class'=>'col-md-3']) !!}
                        <div class="col-md-9">
                            {!! Form::file('imported_file', array('class' => 'form-control')) !!}
                            {{--{!! $errors->first('sample_file', '<p class="alert alert-danger">:message</p>') !!}--}}
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    {!! Form::submit('Upload',['class'=>'btn btn-primary']) !!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

</body>
</html>