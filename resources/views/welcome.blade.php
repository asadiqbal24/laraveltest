<!DOCTYPE html>

<html>

<head>

   <title>Laravel Test</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" />

   <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" />




</head>

<body>

<div class="container">

   

   <div class="row justify-content-centre" style="margin-top: 4%">

       <div class="col-md-12">

           <div class="card">

               <div class="card-header bgsize-primary-4 white card-header">

                   <h4 class="card-title">Import Excel Sheet</h4>

               </div>

               <div class="card-body">

                   @if ($message = Session::get('success'))




                       <div class="alert alert-success alert-block">




                           <button type="button" class="close" data-dismiss="alert">×</button>




                           <strong>{{ $message }}</strong>




                       </div>

                       <br>

                   @endif

                   <form action="{{route('importData')}}" method="post" enctype="multipart/form-data">

                       @csrf

                       <fieldset>

                           <label>Select File to Upload  <small class="warning text-muted">{{__('Please upload only Excel (.xlsx or .xls) files')}}</small></label>

                           <div class="input-group">

                               <input type="file" required class="form-control" name="uploaded_file" id="uploaded_file">

                                   

                               <div class="input-group-append" id="button-addon2">

                                   <button class="btn btn-primary square" type="submit"><i class="ft-upload mr-1"></i> Upload</button>

                               </div>

                           </div>
                           @if ($errors->has('uploaded_file'))

                                       <p class=" mb-0" style="margin-top: 20px;">

                                           <small  id="file-error" style="color:red;">{{ $errors->first('uploaded_file') }}</small>

                                       </p>

                                   @endif

                       </fieldset>

                   </form>

               </div>

           </div>

       </div>

   </div>




   <div class="row justify-content-left">

       <div class="col-md-12">

           <br />

           <div class="card">

               <div class="card-header bgsize-primary-4 white card-header">

                   <h4 class="card-title">Customer Data</h4>

               </div>

               <div class="card-body">

                   

                   <div class=" card-content table-responsive">

                       <table id="example" class="table table-striped table-bordered" style="width:100%">

                           <thead>

                           <th>#</th>

                           <th>Description</th>

                           <th>Amount</th>
                           <th>Action</th>


                           </thead>

                           <tbody>

                           @if(!empty($data) && $data->count())
                               @php $i=1
                               @endphp
                               @foreach($data as $row)

                                   <tr>

                                       <td>{{$i++}}</td>

                                       <td>{{ $row->description }}</td>

                                       <td>{{ $row->amount }}</td>

                                       <td><a href="{{route('customer-data-delete',['id'=>$row->id])}}" class="btn btn-primary">Delete</a></td>

                                   </tr>

                               @endforeach

                           @else

                               <tr>

                                   <td colspan="10">There are no data.</td>

                               </tr>

                           @endif




                           </tbody>




                       </table>

                       {!! $data->links() !!}

                   </div>

               </div>

           </div>

       </div>




   </div>

   <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>

   <script>

       $(document).ready(function() {

           $('#example').DataTable();

       } );

   </script>

</body>




</html>