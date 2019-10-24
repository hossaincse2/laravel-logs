@extends('laravel-logs::layouts.app')
@section('content')



@if(Session::has('message'))
<div class="alert alert-success   show" role="alert">
    {{ Session::get('message') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<div class="container-fluid spark-screen">
    <div class="row">
        <div class="col-md-12">
            <!-- Horizontal Form -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title"></h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="" action="{{ url($url) }}" method="get" id="auditLogForm" name="auditLogForm">
                    <div class="box-body">
                        <div class="row"> 

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="start_at">Start Date</label>
                                    <input class="form-control" type="date" value="{{date('Y-m-d')}}" id="start_at" name="start_at" >
                                </div>
                            </div>                         
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label  for="end_at">End Date</label>
                                    <input class="form-control" type="date" id="end_at" value="{{date('Y-m-d')}}" name="end_at"  >
                                </div>
                            </div>
                        </div> 
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer ">
                        <div class="col-md-12 ">                                     				
                            <div class="form-group pull-right">
                                <button class="btn btn-success "  type="button" onclick="search();"><span class="glyphicon glyphicon-search"></span> Search </button> 
                                <button class="btn btn-primary " formtarget="_blank" type="submit"><span class="glyphicon glyphicon-list-alt"></span> Print</button> 
                            </div>
                        </div>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid spark-screen">
    <div class="row">
        <div class="col-md-12">
            <!-- Horizontal Form -->
            <div class="box box-info">
                <div class="box-header with-border ">
<!--                    <div class="pull-right"> <a href="" class="btn btn-danger "><span class="glyphicon glyphicon-plus-sign"></span> Add Company</a></div>-->
                </div>
                <!-- /.box-header -->
                <!-- form start -->

                <div class="box-body table-responsive">
                    <div id="onLoadData">

                    </div>
                    <!-- /.box-body -->
                </div>

            </div>
        </div>
    </div>
</div>

@endsection



@push('scripts')
<script type="text/javascript">
                                    function search() {
                                        var data = $("#auditLogForm").serialize();
                                                              
                                        $.ajax(
                                                {
                                                    type: 'GET',
                                                    url: '/report/audit-log-ajax/',
                                                    data: data,
                                                    //datatype: json,
                                                    success: function(data) {
                                                        $("#onLoadData").html(data);
                                                        displayDatatable();
                                                    }
                                                }
                                        );
                                    }

                                    window.onload = search;
</script>
@endpush

