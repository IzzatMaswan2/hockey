<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="{{ asset('css/formation.css') }}" rel="stylesheet">

    <style>
        .icon {
            font-size: 50px;
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
                <h1 class="text-center" style="color:#5D3CB8;font-weight:bold;">Line-Up</h1>

                <p>Choose jersey color:</p>
                <input type="color" id="colorPickerAll" value="#000000">

                <p>Choose jersey color (Goal Keeper):</p>
                <input type="color" id="colorPickerGK" value="#000000">

                <div class="whatthe">
                    <img src="img/hockey_.jpg" style="width:500px" alt="Hockey Field">

                    <div class="gki text-center">
                        <i class='bx bxs-t-shirt gki'></i>
                        <div class="details-gk">
                            GK | {{ $teams->where('formationPosition', 'Goal Keeper')->first()->fullName ?? ' ' }} | {{ $teams->where('formationPosition', 'Goal Keeper')->first()->jerseyNumber ?? ' '  }}
                        </div>
                    </div>  

                    <div class="rdi text-center">
                        <i class='bx bxs-t-shirt rdi'></i>
                        <div class="details-rd">
                            RD | {{ $teams->where('formationPosition', 'Right Defender')->first()->fullName ?? ' ' }} | {{ $teams->where('formationPosition', 'Right Defender')->first()->jerseyNumber ?? ' ' }}
                        </div>
                    </div> 

                    <div class="ldi text-center">
                        <i class='bx bxs-t-shirt ldi'></i>
                        <div class="details-ld">
                            LD | {{ $teams->where('formationPosition', 'Left Defender')->first()->fullName ?? ' ' }} | {{ $teams->where('formationPosition', 'Left Defender')->first()->jerseyNumber ?? ' ' }}
                        </div>
                    </div> 

                    <div class="rmi text-center">
                        <i class='bx bxs-t-shirt rmi'></i>
                        <div class="details-rm">
                            RM | {{ $teams->where('formationPosition', 'Right Midfielder')->first()->fullName ?? ' ' }} | {{ $teams->where('formationPosition', 'Right Midfielder')->first()->jerseyNumber ?? ' ' }}
                        </div>
                    </div> 

                    <div class="cmi text-center">
                        <i class='bx bxs-t-shirt cmi'></i>
                        <div class="details-cm">
                            CM | {{ $teams->where('formationPosition', 'Center Midfielder')->first()->fullName ?? ' ' }} | {{ $teams->where('formationPosition', 'Center Midfielder')->first()->jerseyNumber ?? ' ' }}
                        </div>
                    </div> 

                    <div class="lmi text-center">
                        <i class='bx bxs-t-shirt lmi'></i>
                        <div class="details-lm">
                            LM | {{ $teams->where('formationPosition', 'Left Midfielder')->first()->fullName ?? ' ' }} | {{ $teams->where('formationPosition', 'Left Midfielder')->first()->jerseyNumber ?? ' ' }}
                        </div>
                    </div> 

                    <div class="rii text-center">
                        <i class='bx bxs-t-shirt rii'></i>
                        <div class="details-ri">
                            RI | {{ $teams->where('formationPosition', 'Right Inner')->first()->fullName ?? ' ' }} | {{ $teams->where('formationPosition', 'Right Inner')->first()->jerseyNumber ?? ' ' }}
                        </div>
                    </div> 

                    <div class="lii text-center">
                        <i class='bx bxs-t-shirt lii'></i>
                        <div class="details-li">
                            LI | {{ $teams->where('formationPosition', 'Left Inner')->first()->fullName ?? ' ' }} | {{ $teams->where('formationPosition', 'Left Inner')->first()->jerseyNumber ?? ' ' }}
                        </div>
                    </div> 

                    <div class="rfi text-center">
                        <i class='bx bxs-t-shirt rfi'></i>
                        <div class="details-rf">
                            RF | {{ $teams->where('formationPosition', 'Right Forward')->first()->fullName ?? ' ' }} | {{ $teams->where('formationPosition', 'Right Forward')->first()->jerseyNumber ?? ' ' }}
                        </div>
                    </div> 

                    <div class="cfi text-center">
                        <i class='bx bxs-t-shirt cfi'></i>
                        <div class="details-cf">
                            CF | {{ $teams->where('formationPosition', 'Center Forward')->first()->fullName ?? ' ' }} | {{ $teams->where('formationPosition', 'Center Forward')->first()->jerseyNumber ?? ' ' }}
                        </div>
                    </div> 

                    <div class="lfi text-center">
                        <i class='bx bxs-t-shirt lfi'></i>
                        <div class="details-lf">
                            LF | {{ $teams->where('formationPosition', 'Left Forward')->first()->fullName ?? ' ' }} | {{ $teams->where('formationPosition', 'Left Forward')->first()->jerseyNumber ?? ' ' }}
                        </div>
                    </div> 

                    
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Position</th>
                            <th>Name</th>
                            <th style="display: none;">Center Division</th> <!-- Hidden Column -->
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($teams) && count($teams) > 0)
                            @foreach($teams as $team)
                                <tr>
                                    <td>{{ $team->formationPosition }}</td>
                                    <td>{{ $team->fullName }}</td>
                                    <td style="display: none;"> <!-- Hidden Column for Center Position -->
                                        @if($team->formationPosition === 'CM' || $team->formationPosition === 'CF')
                                            <div>Right</div>
                                            <div>Center</div>
                                            <div>Left</div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="3">No data available</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>  

    <script>
        // JavaScript to handle color change for all players
        const colorPickerAll = document.getElementById('colorPickerAll');
        const allIcons = document.querySelectorAll('.rdi, .ldi, .rmi, .cmi, .lmi, .rii, .lii, .rfi, .cfi, .lfi');

        colorPickerAll.addEventListener('input', function() {
            allIcons.forEach(function(icon) {
                icon.style.color = colorPickerAll.value;
            });
        });

        // JavaScript to handle color change for the goalkeeper
        const colorPickerGK = document.getElementById('colorPickerGK');
        const gkIcon = document.querySelector('.gki');

        colorPickerGK.addEventListener('input', function() {
            gkIcon.style.color = colorPickerGK.value;
        });
    </script>

</body>
@include('layouts.footer')
</html>
