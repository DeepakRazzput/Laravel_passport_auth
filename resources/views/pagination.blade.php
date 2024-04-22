<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee List</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <form id="perPageForm">
        <label for="page">Records per page 10 Records:</label>
        <input type="number" id="page" name="page" min="1" value="10">
        <button type="submit">Apply</button>
    </form>
    <div id="employee-list">
        <!-- Employees will be loaded here -->
    </div>
    
    <script>
        $(document).ready(function(){
            var page = 1;
            var perPage = 10; // Default records per page
            
            loadEmployees(page, perPage);

            $(window).scroll(function() {
                if($(window).scrollTop() + $(window).height() == $(document).height()) {
                    page++;
                    loadEmployees(page, perPage);
                }
            });

            $('#perPageForm').submit(function(e) {
                e.preventDefault();
                page = $('#page').val();
                $('#employee-list').empty(); // Clear existing list
                loadEmployees(page, perPage); 
            });

            function loadEmployees(page, perPage) {
                $.ajax({
                    url: 'api/employees?page=' + page + '&perPage=' + perPage,
                    type: 'GET',
                    success: function(response) {
                        if(response.length > 0) {
                            var html = '';
                            response.forEach(function(employee){
                                html += '<div>';
                                html += '<p>Name: ' + employee.name + '</p>';
                                html += '<p>Email: ' + employee.email + '</p>';
                                html += '</div>';
                            });
                            $('#employee-list').append(html);
                        } else {
                            $(window).off('scroll');
                        }
                    }
                });
            }
        });
    </script>
</body>
</html>
