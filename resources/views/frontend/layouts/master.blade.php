<!DOCTYPE html>
<html lang="en">

@include('frontend.layouts.head')

<body>
    
    
    @include('frontend.layouts.bawah-body')
    
    
    @include('frontend.layouts.top-header')
    
    
    
    @include('frontend.layouts.header')
    
    
    
    @yield('content')
    
    
    
    @include('frontend.layouts.footer')
    
    
    
    @include('frontend.layouts.script')

    
    
    <script>
        var availableTags = [];
        $.ajax({
            method: "GET",
            url: "/produk-list",
            success: function (response) {
                // console.log(response);
                startAutoComplete(response);  
            }
        });
        
        function startAutoComplete(availableTags)
        {
            $("#search_produk").autocomplete({
                source: availableTags
            });
        }
        
    </script>
    
    
    
    @if (session('status'))
    <script>
        Swal.fire({
            title: "Berhasil",
            icon: "success",
            timer: 5000,
            confirmButtonColor: "#f35a38",
            confirmButtonText: "Oke",
            text: '{{ session('status') }}',
        })
    </script>
    @elseif (session('error'))
    <script>
        Swal.fire({
            title: "Gagal",
            icon: "error",
            timer: 5000,
            confirmButtonColor: "#f35a38",
            confirmButtonText: "Oke",
            text: '{{ session('error') }}',
        })
    </script>
    @endif
    
</body>
</html>