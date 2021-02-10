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
               <h3>{{ ucwords('Laravel custom search in datatables using ajax')}}</h3>
           </div>
            </div>
            <div class="row">
                <div class="col-md-6 offset-3">
                    <div class="form-group">
                        <select name="filter_gender" id="filter_gender" class="form-control" required>
                            <option value="">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="filter_country" id="filter_country" class="form-control" required>
                            <option value="">Select country</option>
                            @foreach ($country_name as $country)
                                <option value="{{ $country->Country }}">{{ $country->Country }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group" align="center">
                        <button type="button" class="btn btn-info" name="filter" id="filter">Filter</button>
                        <button type="button" class="btn btn-default" name="reset" id="reset">Reset</button>
                    </div>
                </div>
            </div>
       </center>
       <div class="row mt-5">
           <div class="col-md-10 offset-1">
               <div class="table-responsive">
                   <table id="customer_data" class="table table-striped" >
                       <thead>
                           <tr>
                               <th>CustomerName</th>
                               <th>Gender</th>
                               <th>Address</th>
                               <th>City</th>
                               <th>PostalCode</th>
                               <th>Country</th>
                           </tr>
                       </thead>
                       <tbody>
                           
                       </tbody>
                       {{-- <tfoot>
                        <tr>
                          <td>
                            <input type="text"  placeholder="Search for first name..." class="form-control filter-input" data-column="0">
                          </td>
                          <td>
                            <input type="text"  placeholder="Search for first email..." class="form-control filter-input" data-column="1">
                          </td>
                          <td>
                            <input type="text"  placeholder="Search for first department..." class="form-control filter-input" data-column="2">
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <select data-column="0" class="form-control filter-select">
                              <option value="">Select name...</option>
                              @foreach ($countries as $name)
                                  <option value="{{ $name }}">{{ $name }}</option>
                              @endforeach
                            </select>
                          </td>
                          <td>
                            <select data-column="2" class="form-control filter-select">
                              <option value="">Select department...</option>
                              @foreach ($gender as $name)
                                  <option value="{{ $name }}">{{ $name }}</option>
                              @endforeach
                            </select>
                          </td>
                        </tr>
                      </tfoot> --}}
                   </table>
               </div>
           </div>
       </div>
   </div>
</body>
</html>
<script>
    $(document).ready(function() {
        fill_database();

        // fetch items from DB to the datatable
        function fill_database(filter_gender = '', filter_country = '') {
            var dataTable = $('#customer_data').DataTable({
                processing: true,
                serverSide: true,
                ajax: ({
                    url:'{!! route('customsearch.index') !!}',
                    data: {filter_gender:filter_gender, filter_country:filter_country},
                }),
                
                columns: [
                    {data:'CustomerName', name:'CustomerName'},
                    {data:'Gender', name:'Gender'},
                    {data:'Address', name:'Address'},
                    {data:'City', name:'City'},
                    {data:'PostalCode', name:'PostalCode'},
                    {data:'Country', name:'Country'},
                ]
            });
        }

        //filter search on click event
        $('#filter').click(function() {
            var filter_gender = $('#filter_gender').val();
            var filter_country = $('#filter_country').val();

            // check if  gender is been selected
            if(filter_gender != '' && filter_country != '') {
                // destroy table items
                $('#customer_data').DataTable().destroy();
                // populate the table based on the selection
                fill_database(filter_gender, filter_country);
            } else {
                alert('Select Both filter option');
            }
        });

        //reset data back to normal after search
        $('#reset').click(function() {
            $('#filter_gender').val('');
            $('#filter_country').val('');
            $('#customer_data').DataTable().destroy();
            fill_database();
        });
    })
</script>