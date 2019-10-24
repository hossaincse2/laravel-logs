

<table  class="table table-striped table-bordered nowrap display" style="width:100%">
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
            <td>{{$list->long_text}}</td>
        </tr>
        @endforeach
    </tbody>
</table>