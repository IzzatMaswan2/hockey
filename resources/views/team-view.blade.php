<!DOCTYPE html>
<html lang="en">
<head>
    <title>View Team</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

 <style>
.whatthesigma {
position: relative;
width: 100%;
max-width: 600px;
margin: 0 auto; 
}

.whatthesigma img {
width: 400px; 
}
.whatthesigma .gk {
    background-size:16px;
position:absolute;
top: 8%; 
left: 28.75%;
border-radius:110px;
font-size:18px;
font-weight:bold;
width:50px;
height:50px;
}

.whatthesigma .rd {
position:absolute;
top: 18%; 
left: 18.5%;
border-radius:100px;
font-size:18px;
font-weight:bold;
width:50px;
height:50px;
}

.whatthesigma .ld {
position:absolute;
top: 18%; 
left: 40%;
border-radius:100px;
font-size:18px;
font-weight:bold;
width:50px;
height:50px;
}

.whatthesigma .rm {
position:absolute;
top: 29%; 
left: 8%;
border-radius:100px;
font-size:18px;
font-weight:bold;
width:50px;
height:50px;
}

.whatthesigma .cm {
position:absolute;
top: 29%; 
left: 28.75%;
border-radius:100px;
font-size:18px;
font-weight:bold;
width:50px;
height:50px;
}

.whatthesigma .lm {
position:absolute;
top: 29%; 
left: 51%;
border-radius:100px;
font-size:18px;
font-weight:bold;
width:50px;
height:50px;
}

.whatthesigma .ri {
position:absolute;
top: 41%; 
left: 18.5%;
border-radius:100px;
font-size:18px;
font-weight:bold;
width:50px;
height:50px;
}

.whatthesigma .li {
position:absolute;
top: 41%; 
left: 40%;
border-radius:100px;
font-size:18px;
font-weight:bold;
width:50px;
height:50px;
}

.whatthesigma .rf {
position:absolute;
top: 51.5%; 
left: 8%;
border-radius:100px;
font-size:18px;
font-weight:bold;
width:50px;
height:50px;
}

.whatthesigma .cf {
position:absolute;
top: 51.5%; 
left: 28.75%;
border-radius:100px;
font-size:18px;
font-weight:bold;
width:50px;
height:50px;
}

.whatthesigma .lf {
position:absolute;
top: 51.5%; 
left: 51%;
border-radius:100px;
font-size:18px;
font-weight:bold;
width:50px;
height:50px;
}

button:hover {
    background-color:red;
    color:white;
    border: 3px solid white;
    transition: 0.15s;
}

.bg-modal {
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7); /* Semi-transparent background */
    position: absolute;
    top: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 0;
    padding: 0;
}

.modal-content {
    margin-left: 725px;
    margin-right: 500px;
    height: 300px;
    width: 10px;
    background-color: white; /* This is already full opacity */
    opacity: 1; /* Ensure full opacity */
}

</style>
</head>
<body>


    @include('layouts.navbar')

    <div class="container-fluid" style="height: 90%; padding: 0;">
        <div class="row">
            <div class="col-3" style="background-color: #D3D3D3;">
                @include('layouts.sidebar-manager')
            </div>

            <div class="col-9 mt-5">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="text-center" style="color:#5D3CB8;font-weight:bold;">Formation</h1>
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>
                <div class="whatthesigma">
                    <img src="img/hockey_.jpg" alt="Hockey Field">
                    
                    <button class="gk">GK</button>
                    <button class="rd">RD</button>
                    <button class="ld">LD</button>
                    <button class="rm">RM</button>
                    <button class="cm">CM</button>
                    <button class="lm">LM</button>
                    <button class="ri">RI</button>
                    <button class="li">LI</button>
                    <button class="rf">RF</button>
                    <button class="cf">CF</button>
                    <button class="lf">LF</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
@include('layouts.footer')
<div class="bg-modal">
        <div class="modal-content">
            
        </div>

    </div>
</html>
