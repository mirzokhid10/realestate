@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <!-- Include SweetAlert CSS and JS -->
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> --}}

    <div class="page-content">
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <a href="{{ route('add.agent') }}" class="btn btn-inverse-info"> Add Agent </a>
            </ol>
        </nav>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Agent All </h6>
                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>Sl </th>
                                        <th>Image </th>
                                        <th>Name </th>
                                        <th>Role </th>
                                        <th>Status </th>
                                        <th>Change </th>
                                        <th>Action </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($allagent as $key => $item)
                                        <tr>
                                            <td class="text-start align-middle">{{ $key + 1 }}</td>
                                            <td class="text-start align-middle"><img
                                                    src="{{ !empty($item->photo) ? url('upload/agent_images/' . $item->photo) : url('upload/no_image.jpg') }}"
                                                    style="width:70px; height:40px; padding: 0;"> </td>
                                            <td class="text-start align-middle">{{ $item->name }}</td>
                                            <td class="text-start align-middle">{{ $item->role }}</td>
                                            <td class="text-start align-middle">
                                                @if ($item->status == 'active')
                                                    <span class="badge rounded-pill bg-success px-2 py-1">Active</span>
                                                @else
                                                    <span class="badge rounded-pill bg-danger px-2 py-1">InActive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <input data-id="{{ $item->id }}" class="toggle-class" type="checkbox"
                                                    data-onstyle="success" data-offstyle="danger" data-toggle="toggle"
                                                    data-on="Active" data-off="Inactive"
                                                    {{ $item->status ? 'checked' : '' }}>
                                            </td>
                                            <td class="text-start align-middle">
                                                <a href="{{ route('edit.agent', $item->id) }}"
                                                    class="btn btn-inverse-warning" title="Edit"> <i
                                                        data-feather="edit"></i> </a>

                                                <a href="{{ route('delete.agent', $item->id) }}"
                                                    class="btn btn-inverse-danger" id="delete" title="Delete"> <i
                                                        data-feather="trash-2"></i> </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(function() {
          $('.toggle-class').change(function() {
              var status = $(this).prop('checked') == true ? 1 : 0;
              var user_id = $(this).data('id');

              $.ajax({
                  type: "GET",
                  dataType: "json",
                  url: '/changeStatus',
                  data: {'status': status, 'user_id': user_id},
                  success: function(data){
                    // console.log(data.success)
                    // Start Message
                  const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 3000
                  })
                  if ($.isEmptyObject(data.error)) {

                          Toast.fire({
                          type: 'success',
                          title: data.success,
                          })
                  }else{

                  Toast.fire({
                          type: 'error',
                          title: data.error,
                          })
                      }
                    // End Message
                  }
              });
          })
        })
    </script>
@endsection


