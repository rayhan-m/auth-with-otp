<!DOCTYPE html>
<html lang="en" dir="">

<!-- Mirrored from demos.ui-lib.com/gull/html/layout4/dashboard1.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 22 Feb 2020 18:09:01 GMT -->
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>{{getSetting()->site_name}} | {{getSetting()->site_title}}</title>
    <link rel="shortcut icon" href="{{asset('/')}}{{ getSetting()->fav }}" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('public/css/ionicons.min.css') }}">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <link href="{{ asset('public/backend/css/themes/lite-purple.css') }}" rel="stylesheet" />
    
    

    
    <link href="{{ asset('public/backend/css/plugins/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('public/backend/css/plugins/fontawesome-5.css') }}" />
    <link href="{{ asset('public/backend/css/plugins/metisMenu.min.css') }}" rel="stylesheet" />
    
    <link href="{{ asset('public/backend/css/style.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('public/backend/css/plugins/datatables.min.css') }}" />
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>
    <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.ckeditor.com/ckeditor5/16.0.0/classic/ckeditor.js"></script>
    

    
</head>
<script type="text/javascript">
        function isNumberKey(evt) {
            var charCode = (evt.which) ? evt.which : (event.keyCode);
            if (charCode > 31 && (charCode < 48 || charCode > 57)){
                return false;
            }
            return true;
        }
    </script>
     <script type="text/Javascript">
        function isNumberKeyDecimal(el){
            var ex = /^[0-9]+\.?[0-9]*$/;
                if(ex.test(el.value)==false){
                el.value = el.value.substring(0,el.value.length - 1);
            }
        }
</script>
<script type="text/javascript">  
            window.onload = function() {
            clock();  
                function clock() {
                var now = new Date();
                var TwentyFourHour = now.getHours();
                var hour = now.getHours();
                var min = now.getMinutes();
                var sec = now.getSeconds();
                var mid = 'PM';
                if (min < 10) {
                min = "0" + min;
                }
                if (hour > 12) {
                hour = hour - 12;
                }    
                if(hour==0){ 
                hour=12;
                }
                if(TwentyFourHour < 12) {
                mid = 'AM';
                }     
            document.getElementById('date_time').innerHTML =     hour+':'+min+':'+sec +' '+mid ;
                setTimeout(clock, 1000);
                }
            }
        </script>
<body class="text-left">
    <div class="app-admin-wrap layout-sidebar-vertical sidebar-full">
        <div class="sidebar-panel">
            
            <div class="gull-brand pr-3 text-center mt-4 mb-2 d-flex justify-content-center align-items-center"><img class="pl-3" style="height:40px; width:140px;" src="{{asset('/')}}{{getSetting()->logo}}" alt="alt" />
                <!--  <span class=" item-name text-20 text-primary font-weight-700">GULL</span> -->
                <div class="sidebar-compact-switch ml-auto"><span></span></div>
            </div>
            <!--  user -->
            <div class="scroll-nav ps ps--active-y" data-perfect-scrollbar="data-perfect-scrollbar" data-suppress-scroll-x="true">