

@section('htmlheader_title')
ERROR LOG REPORT
@endsection


<link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
<body style="padding:30px; text-align:center">
    <form style="text-align: center">

        <div align="center">
            <table border="0" align="center" width="921" style="text-align:center;">

                <tr>
                    <td><strong>ERROR LOG REPORT </strong></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>                
                </tr>

                @if($request['user_type']=="store")
                <tr>        
                    <td><strong>Store</strong>: {{ Auth::user()->store->name}}</td>
                </tr>
                @endif

                @if($request['user_type']=="factory")
                <tr>        
                    <td><strong>Factory</strong>: {{Auth::user()->factory->name}}</td>
                </tr>
                @endif

                @if(isset($request['start_at']))
                <tr>        
                    <td><strong>Date</strong>: {{$request['start_at']}} To {{$request['end_at']}}</td>
                </tr>
                @endif
            </table><br>      

            <table border="0"  class="table table-striped"  style="width:100%">
                <thead>
                    <tr>
                        <th>#SL</th>
                        <th>Title</th>
                        <th>Client IP</th>
                        <th>User</th>
                        <th>Crate Date</th>
                        <th>Request URl</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $i=1;
                    @endphp

                    @foreach ($data as $list)   
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$list->title}}</td>
                        <td>{{$list->client_ip}}</td>
                        <td>{{$list->user->name}}</td>
                        <td>{{$list->created_at}}</td>
                        <td>{{$list->request_uri}}</td>
                        <td style="width: 40px;">{{$list->long_text}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>



        </div>
    </form>
</body>

