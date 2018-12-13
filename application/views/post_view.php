<!DOCTYPE html>
<html lang="en">
<head>
    <title>Codeigniter 3 Ajax Pagination using Jquery Example - ItSolutionStuff.com</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <style type="text/css">
        html, body { font-family: 'Raleway', sans-serif; }
        a{ color: #007bff; font-weight: bold;}
    </style>
</head>
<body>

<div class="container">
    <div class="card">
        <div class="card-header">
            Codeigniter Ajax Pagination Example - ItSolutionStuff.com
        </div>
        <div class="card-body">
            <!-- Posts List -->
            <table class="table table-borderd" id='postsList'>
                <thead>
                <tr>
                    <th>S.no</th>
                    <th>Title</th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>

            <!-- Paginate -->
            <div id='pagination'></div>
        </div>
    </div>
</div>
<!-- Script -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script type='text/javascript'>
    $(document).ready(function () {
       $('#pagination').on('click','a',function (e) {
           e.preventDefault();
           var pageno = $(this).attr('data-ci-pagination-page');
           loadPagination(pageno);

       }) ;

       loadPagination(0);

       function loadPagination(pagno) {
           $.ajax({
               url:"<?php echo base_url(); ?>index.php/post/loadRecord/"+ pagno,
               type: 'get',
               dataType: 'json',
               success:function (response) {
                   $('#pagination').html(response.pagination);
                   createTable(response.result,response.row);

               }
           });
       }
       function createTable(result,sno) {
           sno = Number(sno);
           $('#postsList tbody').empty();
           for(index in result){
               var id = result[index].id;
               var title = result[index].title;
               var content = result[index].slug;
               content = content.substr(0,60)+ "...";
               var link = result[index].slug;
               sno+=1;

               var tr = "<tr>";
               tr += "<td>"+ sno +"</td>";
               tr += "<td><a href='"+ link +"' target='_blank' >"+ title +"</a></td>";
               tr += "</tr>";
               $('#postsList tbody').append(tr);
           }
       }
    });
    </script>
</body>
</html>