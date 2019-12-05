@extends('layouts.admin')
@section('content')
    <div class="container">
        <h4>Foods</h4>
        <table class="table table-responsive" style="width: 1000px">
            <thead>
                <tr>
                    <th scope="col" style="width:130px">Name</th>
                    <th scope="col" style="width:130px">Category</th>
                    <th scope="col" style="width:250px">Description</th>
                    <th scope="col" style="width:100px">Price</th>
                    <th scope="col" style="width:150px">Status</th>
                    <th scope="col" style="width:120px">Date Added</th>
                    <th scope="col"> ... </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($item as $i)
                    <tr>
                        <td> {{$i->name}} </td>
                        <td> {{$i->category}} </td>
                        {{-- <td> {{str_limit($i->description, $limit=50, $end = '...')}} </td> --}}
                        <td> {{substr($i->description, 0, 20)}} </td>
                        <td> {{$i->price}} </td>
                        <td>
                            @if ($i->status == 1)
                                <div style="color:green"><b>Available</b></div>
                            @else 
                                <div style="color:red"><b>Not Available</b></div> 
                            @endif
                        </td>
                        <td> {{$i->date_added}} </td>
                        <td>
                            @if ($i->status == 0)
                                <a class="btn btn-outline-primary" href="{{ url('/admin/activateItem/'.$i->item_id) }}"> Activate </a>
                            @else
                                <a class="btn btn-outline-danger" href="{{ url('/admin/deactivateItem/'.$i->item_id) }}"> Deactivate </a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $item->links()}}
    </div>
@endsection