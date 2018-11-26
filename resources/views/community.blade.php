<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
    @include('includes.head')
    <link rel="stylesheet" href="{{URL::asset('/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
  <style>
      .loading {
          background: lightgrey;
          padding: 15px;
          position: fixed;
          border-radius: 4px;
          left: 50%;
          top: 50%;
          text-align: center;
          margin: -40px 0 0 -50px;
          z-index: 2000;
          display: none;
      }

      .form-group.required label:after {
          content: " *";
          color: red;
          font-weight: bold;
      }
      .content-header2{overflow:hidden}
      td
      {
            text-align: left !important;
            vertical-align: top !important;
      }
  </style>
</head>

<body class="hold-transition skin-blue-light sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">
    @include('includes.header')
  </header>

  <aside class="main-sidebar">
    @include('includes.sidebar')
  </aside><!-- left-side menu -->

  <div class="content-wrapper">
    <section class="content container-fluid">
        
        <!-- page content starts here -->     
        <div class="content-header content-header2" >
           <h1 style="float:left;">View Communitites</h1>

           <span class="search-controls" style="float:right;">
             
             <a href="{{url('add_community')}}" class="btn btn-default fill"> Add Communitity </a>  
            </span>
        </div>
           

          <div class="box">

            <!-- /.box-header -->

            <div class="box-body" style="overflow-x:scroll">



              <table id="example1" class="table table-responsive no-padding video-list1" style="overflow-x:scroll;">

                <thead>

                <tr>
                  <th style="display: none"></th>

                  <th>#Community ID </th>

                  <th>Service Title</th>
                  <th>Venue</th> 
                  <th>StartDate</th>
                  <th>StartTime</th>
                  <th>EndTime</th>
                  <th>BannerPic</th>
                  <th>State</th>
                  <th>City </th>
                  <th>AboutService</th>
                  <th>Organizer</th>
                  <th>OrganizerImg</th>
                  <th>Action</th>
                  

                </tr>

                </thead>

                <tbody>

                  @if (!empty($community))

                  @foreach($community as $d)

                  @if($d->id !='')
                <tr>

                  <td style="display: none"></td>

                  <td>{{$d->id}}</td>

                  <td>{{$d->ServiceTitle}}</td>
                  <td>@if(strlen($d->Venue) < 20)
                  	{!! $d->Venue !!}
                  	@else
                  	{!! (substr($d->Venue, 0, 20)) !!}...
                    @endif
                  </td> 
                  <td>{{$d->StartDate}}</td>
                  <td>{{$d->StartTime}}</td>
                  <td>{{$d->EndTime}}</td>
                  <td><img src="{{URL::asset('images').'/'.$d->BannerPic}}" style="width:50px;height: 50px;"></td>
                  <td>{{$d->State}}</td>
                  <td>{{$d->City}}</td>
                  <td>
                  	@if(strlen($d->AboutService) < 20)
                    {{ strip_tags($d->AboutService) }}
                    @else
                    {{ (substr(strip_tags($d->AboutService), 0, 20)) }}...
                    @endif
                  </td>
                  <td>{{ strip_tags($d->Organizer) }}</td>
                  <td>
                    <img src="{{URL::asset('images').'/'.$d->OrganizerImg}}" style="width:50px;height: 50px;">
                  </td>
                  <td>
                    <a  href="{{route('edit_community',$d->id)}}"><i class="fa fa-edit"></i>
                    </a>
                    <a href="#delete{{$d->id}}" data-toggle="modal"><i class="fa fa-trash"></i></a>
                  </td>

 <div class="modal fade" id="delete{{$d->id }}" tabindex="-1"  aria-hidden="true" role="basic">
              <div class="modal-dialog modal-sm">
                <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                      <h4 class="modal-title">Delete Community</h4>
                  </div>
                  <form action="{{route('delete_community')}}" method="post">
                  {{csrf_field() }}
                      <div class="modal-body"> Are you want delete the community. </div>
                      <input type="hidden" name="id" value="{{$d->id}}">
                      <div class="modal-footer">
                          <button type="button" class="btn" style="border: 1px solid;background: white;width:80px ! important" data-dismiss="modal">Close</button>
                          <input type="submit" class="btn green">
                      </div>
                  </form>
                </div>
              </div>
            </div>
                </tr>

                @else

                <tr>

                    Data is no exist.

                </tr>

                @endif

                 @endforeach

                 @endif

                </tbody>

              </table>

            </div>
      

          <!-- /.box -->

    </section><!-- /.content -->

</div><!-- /.content-wrapper -->


<!-- REQUIRED JS SCRIPTS -->
@include('includes.foot')
<script src="{{URL::asset('/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<!-- <script src="{{URL::asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script> -->
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true
    })
  })
</script>

</body>
</html>
