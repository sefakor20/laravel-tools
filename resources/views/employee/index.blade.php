<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>
<body>
  
   <div class="container">
       <center>
           <div class="row mt-5">
              <div class="col-md-10 offset-1">
                <h3>{{ ucwords('Filter search')}}</h3>
                <br>
                <div class="form-group">
                  <select data-column="0" class="form-control filter-select">
                    <option value="">Select name...</option>
                    @foreach ($names as $name)
                        <option value="{{ $name }}">{{ $name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <select data-column="2" class="form-control filter-select">
                    <option value="">Select department...</option>
                    @foreach ($departments as $name)
                        <option value="{{ $name }}">{{ $name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
       </center>
       <div class="row mt-5">
           <div class="col-md-10 offset-1">
               <div class="table-responsive">
                   <table id="customer_data" class="table table-bordered table-striped" >
                       <thead>
                           <tr>
                              <th>Name</th>
                              <th>Email</th>
                              <th>Department</th>
                              <th>Phone</th>
                              <th>Salary</th>
                           </tr>
                       </thead>
                       <tbody>
                          
                       </tbody>
                   </table>
                   <br><br>
               </div>
           </div>
       </div>
   </div>
   <script>
     $(document).ready(function () {
       var table = $('#customer_data').DataTable({
         'processing': true,
         'serverSide': true,
         'ajax': '{!! route('employee.index') !!}',
         'columns':[
           {data: 'name'},
           {data: 'email'},
           {data: 'department'},
           {data: 'phone'},
           {data: 'salary'},
         ]
       });

       $('.filter-input').keyup(function() {
         
         table.column( $(this).data('column'))
          .search( $(this).val())
          .draw();
       });
       ()->of($data)->make(true);
      }

      $employees = Employee::all();
      $names = $employees->sortBy('name')->pluck('name')->unique();
      $departments = $employees->sortBy('department')->
       $('.filter-select').change(function() {
         table.column( $(this).data('column'))
          .search( $(this).val())
          .draw();
       });


     });
   </script>
</body>
</html>