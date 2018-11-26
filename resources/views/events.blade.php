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
           <h1 style="float:left;">View Events</h1>

            <span class="search-controls" style="float:right;">
             
             <a href="{{url('add_event')}}" class="btn btn-default fill"> Add Event </a>
            </span>
        </div>
           

          <div class="box">

            <!-- /.box-header -->

            <div class="box-body" style="overflow-x:scroll">



              <table id="example1" class="table table-responsive no-padding video-list1" style="overflow-x:scroll;">

                <thead>

                <tr>
                  <th style="display: none"></th>

                  <th>#Event ID </th>

                  <th>Event Name</th>
                  <th>Start Date</th>
                  <th>Start Time</th>
                  <th>End Time</th>
                  <th>Banner Imgae</th>
                  <th>Venue</th>
                  <th>About Event</th>
                  <th>Buy Ticket URL</th>
                  <th>Organizer</th>
                  <th>Organizer Imgae</th>
                  <th>Action</th>

                </tr>

                </thead>

                <tbody>

                  @if (!empty($events))

                  @foreach($events as $d)

                  @if($d->id !='')
                <tr>

                  <td style="display: none"></td>

                  <td>{{$d->id}}</td>

                  <td>{{$d->EventName}}</td>
                  <td>{{$d->StartDate}}</td>
                  <td>{{$d->StartTime}}</td>
                  <td>{{$d->EndTime}}</td>
                  <td><img src="{{URL::asset('images/'.$d->BannerImg)}}" style="width:50px;height: 50px;"></td>
                  <td>
                    @if(strlen($d->Venu) < 50)
                    {{strip_tags($d->Venu)}}
                    @else
                    {{(substr(strip_tags($d->Venu), 0, 50))}}...
                    @endif
                  </td>
                  <td>{{ strip_tags($d->AboutEvent)}}</td>
                  <td>{{$d->BuyTicketURL}}</td>
                  <td>{!! $d->Organizer !!}</td>
                  <td><img src="{{URL::asset('images/'.$d->OrganizerImg)}}" style="width:50px;height: 50px;"></td>
                  <td>
                    <a  href="{{route('edit-event',$d->id)}}">
                      <i class="fa fa-edit"></i>
                    </a>
                    <a href="#delete{{$d->id}}" data-toggle="modal"><i class="fa fa-trash"></i></a>
                  </td>

          <div class="modal fade" id="delete{{$d->id }}" tabindex="-1"  aria-hidden="true" role="basic">
              <div class="modal-dialog modal-sm">
                <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                      <h4 class="modal-title">Delete Event</h4>
                  </div>
                  <form action="{{route('delete-event')}}" method="post">
                  {{csrf_field() }}
                      <div class="modal-body"> Are you want delete the event. </div>
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
