<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Task</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>
    <div class="main">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-10">
                    <div class="row p-5">
                        <label for="search" class="py-3 h3">Search</label>
                        <input class="form-control" type="text" name="search" id="search"
                            placeholder="Search name / designation / department" />
                    </div>
                    <div id="result" class="px-5"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            function search(val) {
                $.ajax({
                    url: "{{ route('search') }}",
                    method: "GET",
                    data: {
                        'search': val
                    },
                    success: function(data) {
                        $('#result').empty();
                        if (data.length > 0) {
                            let row = $('<div class="row"></div>');
                            data.forEach(function(user) {
                                let card = `
                                    <div class="col-md-6 mb-4">
                                        <div class="card p-4" style="border: 1px solid #ddd; border-radius: 5px;">
                                            <h4 class="fw-bold">${user.name}</h4>
                                            <h5>${user.department.name}</h5>
                                            <h6>${user.designation.name}</h6>
                                        </div>
                                    </div>
                                `;
                                row.append(card);
                            });
    
                            $('#result').append(row);
                        } else {
                            $('#result').html('<p>No result found.</p>');
                        }
                    }
                });
            }
    
            search('');
    
            $('#search').on('keyup', function() {
                let val = $(this).val();
                search(val);
            });
        });
    </script>
    
</body>

</html>
