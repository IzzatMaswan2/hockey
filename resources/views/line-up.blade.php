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

        /* Flexbox container for the image and table */
        .image-table-container {
            display: flex;
            align-items: flex-start;
            gap: 20px; /* Space between image and table */
        }

        /* Style the image */
        .image-table-container img {
            width: 500px;
            
            
            
        }

        /* Style the table */
        .table-container {
            flex: 1;
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
                <h1 class="" style="color:#5D3CB8;font-weight:bold;">Line-Up</h1>

                <div class="image-table-container">
                    <img src="img/hockey.jpg" alt="Hockey Field">

                    <div class="table-container">
                        <table class="table table-bordered text-center" style="padding:2px;">
                            <thead>
                                <tr>
                                    <th style="background-color:purple;color:white;">Position</th>
                                    <th style="background-color:purple;color:white;">Side</th>
                                    <th style="background-color:purple;color:white">Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Goal Keeper -->
                                @php
                                    $gk = $teams->where('formationPosition', 'Goalkeeper')->first();
                                @endphp
                                <tr>
                                    <td style="background-color:#CEADDB;">Goal Keeper</td>
                                    <td colspan="2">{{ $gk ? $gk->fullName : 'None' }}</td> <!-- Remove "None" and merge -->
                                </tr>

                                <!-- Defender Row -->
                                <tr>
                                    <td rowspan="2">Defender</td>
                                    @php
                                        $rd = $teams->where('formationPosition', 'Right Defender')->first();
                                    @endphp
                                    <td style="background-color:#CEADDB;">Right</td>
                                    <td style="background-color:#CEADDB;">{{ $rd ? $rd->fullName : 'None' }}</td>
                                </tr>
                                <tr>
                                    @php
                                        $ld = $teams->where('formationPosition', 'Left Defender')->first();
                                    @endphp
                                    <td>Left</td>
                                    <td>{{ $ld ? $ld->fullName : 'None' }}</td>
                                </tr>

                                <!-- Midfielder Row -->
                                <tr>
                                    <td rowspan="3" style="background-color:#CEADDB;">Midfielder</td>
                                    @php
                                        $rm = $teams->where('formationPosition', 'Right Midfielder')->first();
                                    @endphp
                                    <td style="background-color:#CEADDB;">Right</td>
                                    <td style="background-color:#CEADDB;">{{ $rm ? $rm->fullName : 'None' }}</td>
                                </tr>
                                <tr>
                                    @php
                                        $cm = $teams->where('formationPosition', 'Center Midfielder')->first();
                                    @endphp
                                    <td>Center</td>
                                    <td>{{ $cm ? $cm->fullName : 'None' }}</td>
                                </tr>
                                <tr>
                                    @php
                                        $lm = $teams->where('formationPosition', 'Left Midfielder')->first();
                                    @endphp
                                    <td style="background-color:#CEADDB;">Left</td>
                                    <td style="background-color:#CEADDB;">{{ $lm ? $lm->fullName : 'None' }}</td>
                                </tr>

                                <!-- Inner Row -->
                                <tr>
                                    <td rowspan="2">Inner</td>
                                    @php
                                        $ri = $teams->where('formationPosition', 'Right Inner')->first();
                                    @endphp
                                    <td>Right</td>
                                    <td>{{ $ri ? $ri->fullName : 'None' }}</td>
                                </tr>
                                <tr>
                                    @php
                                        $li = $teams->where('formationPosition', 'Left Inner')->first();
                                    @endphp
                                    <td style="background-color:#CEADDB;">Left</td>
                                    <td style="background-color:#CEADDB;">{{ $li ? $li->fullName : 'None' }}</td>
                                </tr>

                                <!-- Forward Row -->
                                <tr>
                                    <td rowspan="3" style="background-color:#CEADDB;">Forward</td>
                                    @php
                                        $rf = $teams->where('formationPosition', 'Right Forward')->first();
                                    @endphp
                                    <td>Right</td>
                                    <td>{{ $rf ? $rf->fullName : 'None' }}</td>
                                </tr>
                                <tr>
                                    @php
                                        $cf = $teams->where('formationPosition', 'Center Forward')->first();
                                    @endphp
                                    <td style="background-color:#CEADDB;">Center</td>
                                    <td style="background-color:#CEADDB;">{{ $cf ? $cf->fullName : 'None' }}</td>
                                </tr>
                                <tr>
                                    @php
                                        $lf = $teams->where('formationPosition', 'Left Forward')->first();
                                    @endphp
                                    <td>Left</td>
                                    <td>{{ $lf ? $lf->fullName : 'None' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                
                <div class="whatthe">
                   

                    <div class="gki text-center">
                        <i class='bx bxs-t-shirt gki'></i>
                        <div class="jn-gk">
                         {{ $teams->where('formationPosition', 'Goalkeeper')->first()->jerseyNumber ?? ' ' }}
                        </div>
                        <div class="details-gk">
                         {{ $teams->where('formationPosition', 'Goalkeeper')->first()->displayName ?? ' ' }}
                        </div>

                    </div>  

                    <div class="rdi text-center">
                        <i class='bx bxs-t-shirt rdi'></i>
                        <div class="jn-rd">
                              {{ $teams->where('formationPosition', 'Right Defender')->first()->jerseyNumber ?? ' ' }} 
                        </div>
                        <div class="details-rd">
                              {{ $teams->where('formationPosition', 'Right Defender')->first()->displayName ?? ' ' }} 
                        </div>
                    </div> 

                    <div class="ldi text-center">
                        <i class='bx bxs-t-shirt ldi'></i>
                        <div class="jn-ld">
                             {{ $teams->where('formationPosition', 'Left Defender')->first()->jerseyNumber ?? ' ' }} 
                        </div>
                        <div class="details-ld">
                             {{ $teams->where('formationPosition', 'Left Defender')->first()->displayName ?? ' ' }} 
                        </div>
                    </div> 

                    <div class="rmi text-center">
                        <i class='bx bxs-t-shirt rmi'></i>
                        <div class="jn-rm">
                             {{ $teams->where('formationPosition', 'Right Midfielder')->first()->jerseyNumber ?? ' ' }} 
                        </div>
                        <div class="details-rm">
                             {{ $teams->where('formationPosition', 'Right Midfielder')->first()->displayName ?? ' ' }} 
                        </div>
                    </div> 

                    <div class="cmi text-center">
                        <i class='bx bxs-t-shirt cmi'></i>
                        <div class="jn-cm">
                             {{ $teams->where('formationPosition', 'Center Midfielder')->first()->jerseyNumber ?? ' ' }} 
                        </div>
                        <div class="details-cm">
                             {{ $teams->where('formationPosition', 'Center Midfielder')->first()->displayName ?? ' ' }} 
                        </div>
                    </div> 

                    <div class="lmi text-center">
                        <i class='bx bxs-t-shirt lmi'></i>
                        <div class="jn-lm">
                             {{ $teams->where('formationPosition', 'Left Midfielder')->first()->jerseyNumber ?? ' ' }} 
                        </div>
                        <div class="details-lm">
                             {{ $teams->where('formationPosition', 'Left Midfielder')->first()->displayName ?? ' ' }} 
                        </div>
                    </div> 

                    <div class="rii text-center">
                        <i class='bx bxs-t-shirt rii'></i>
                        <div class="jn-ri">
                             {{ $teams->where('formationPosition', 'Right Inner')->first()->jerseyNumber ?? ' ' }} 
                        </div>
                        <div class="details-ri">
                             {{ $teams->where('formationPosition', 'Right Inner')->first()->displayName ?? ' ' }} 
                        </div>
                    </div> 

                    <div class="lii text-center">
                        <i class='bx bxs-t-shirt lii'></i>
                        <div class="jn-li">
                             {{ $teams->where('formationPosition', 'Left Inner')->first()->jerseyNumber?? ' ' }} 
                        </div>
                        <div class="details-li">
                             {{ $teams->where('formationPosition', 'Left Inner')->first()->displayName ?? ' ' }} 
                        </div>
                    </div> 

                    <div class="rfi text-center">
                        <i class='bx bxs-t-shirt rfi'></i>
                        <div class="jn-rf">
                             {{ $teams->where('formationPosition', 'Right Forward')->first()->jerseyNumber ?? ' ' }} 
                        </div>
                        <div class="details-rf">
                             {{ $teams->where('formationPosition', 'Right Forward')->first()->displayName ?? ' ' }} 
                        </div>
                    </div> 

                    <div class="cfi text-center">
                        <i class='bx bxs-t-shirt cfi'></i>
                        <div class="jn-cf">
                             {{ $teams->where('formationPosition', 'Center Forward')->first()->jerseyNumber ?? ' ' }} 
                        </div>
                        <div class="details-cf">
                             {{ $teams->where('formationPosition', 'Center Forward')->first()->displayName ?? ' ' }} 
                        </div>
                    </div> 

                    <div class="lfi text-center">
                        <i class='bx bxs-t-shirt lfi'></i>
                        <div class="jn-lf">
                             {{ $teams->where('formationPosition', 'Left Forward')->first()->jerseyNumber ?? ' ' }} 
                        </div>
                        <div class="details-lf">
                             {{ $teams->where('formationPosition', 'Left Forward')->first()->displayName ?? ' ' }} 
                        </div>

                </div>
                <div class="color-picker-container">
    <div class="color-picker-item">
        <label for="colorPickerAll">Choose jersey color:</label>
        <input type="color" id="colorPickerAll" value="#000000">
    </div>
    
    <div class="color-picker-item">
        <label for="colorPickerGK">Choose jersey color (Goal Keeper):</label>
        <input type="color" id="colorPickerGK" value="#000000">
    </div>
</div>
                
            </div>
        </div>
    </div>  

    <script>
        // JavaScript to handle color change for all players
        const colorPickerAll = document.getElementById('colorPickerAll');
        const colorPickerGK = document.getElementById('colorPickerGK');
        const allIcons = document.querySelectorAll('.rdi, .ldi, .rmi, .cmi, .lmi, .rii, .lii, .rfi, .cfi, .lfi');
        const gkIcon = document.querySelector('.gki');

        // Load stored colors on page load
        document.addEventListener('DOMContentLoaded', function() {
            const storedColorAll = localStorage.getItem('colorAll');
            const storedColorGK = localStorage.getItem('colorGK');
            if (storedColorAll) {
                colorPickerAll.value = storedColorAll;
                allIcons.forEach(function(icon) {
                    icon.style.color = storedColorAll;
                });
            }
            if (storedColorGK) {
                colorPickerGK.value = storedColorGK;
                gkIcon.style.color = storedColorGK;
            }
        });

        // Store color and apply it
        colorPickerAll.addEventListener('input', function() {
            const color = colorPickerAll.value;
            allIcons.forEach(function(icon) {
                icon.style.color = color;
            });
            localStorage.setItem('colorAll', color);
        });

        colorPickerGK.addEventListener('input', function() {
            const color = colorPickerGK.value;
            gkIcon.style.color = color;
            localStorage.setItem('colorGK', color);
        });
    </script>

</body>
@include('layouts.footer')
</html>
