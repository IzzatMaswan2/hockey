<x-layout>
    <div class="main-container">
        <section>
            <div class="userbanner-row">
                <img src="img/bg-user.png" alt="banner-user">
                <div class="user-tab">
                    <div class="tab">
                        <button class="tablinks" onclick="openGroup(event, 'Profile')" id="defaultOpen">Profile</button>
                        <button class="tablinks" onclick="openGroup(event, 'Notification')">Notication</button>
                        <button class="tablinks" onclick="openGroup(event, 'ResetPassword')">Reset Password</button>
                        <button class="tablinks" onclick="openGroup(event, 'Setting')">Setting</button>
                        <button class="tablinks" onclick="openGroup(event, 'Activity')">Activity</button>
                    </div>
                </div>
            </div>
        </section>

        <section id="Profile" class="usertab-section">
        <img src="img/white-bg.jpg" alt="bg"> 
            <div class="infotab-section">
                <div class="user-content">
                    <div class="user-column">
                        <img src="img/JohnDoe.jpg" alt="John Doe"><br>
                        <span>John Doe</span><br>
                        <span>JohnDoe@gmail.com</span>
                    </div>
                    <div class="profile-info">
                        <table>
                            <tr>
                                <td>Username</td>
                                <td>John Doe</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>JohnDoe@gmail.com</td>
                            </tr>
                            <tr>
                                <td>Email Verification</td>
                                <td>Pending</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </section>


        <section id="Notification" class="usertab-section">
        <img src="img/white-bg.jpg" alt="bg"> 
            <div class="infotab-section">
                <div class="user-content">
                    <div class="user-column">
                        <img src="img/JohnDoe.jpg" alt="John Doe"><br>
                        <span>John Doe</span><br>
                        <span>JohnDoe@gmail.com</span>
                    </div>
                    <div class="scrollbox">
                        <div class="scroll-content"><i class="bi bi-bell-fill"></i>
                            Notication 1 A new event has been added to the community calendar
                        </div>
                        <div class="scroll-content"><i class="bi bi-bell-fill"></i>
                            Notification 2 The content has been updated.
                        </div>
                        <div class="scroll-content"><i class="bi bi-bell-fill"></i>
                            Notification 3 The new article has been published.
                        </div>
                        <div class="scroll-content"><i class="bi bi-bell-fill"></i>
                            Notification 4 You have a new friend request.
                        </div>
                        <div class="scroll-content"><i class="bi bi-bell-fill"></i>
                            Notification 5 Someone liked your recent post
                        </div>
                        <div class="scroll-content"><i class="bi bi-bell-fill"></i>
                            Notification 6 Your registration for the event was successful.
                        </div>
                        <div class="scroll-content"><i class="bi bi-bell-fill"></i>
                            Notification 7 A new login to your account was detected from an unrecognized device.
                        </div>
                        <div class="scroll-content"><i class="bi bi-bell-fill"></i>
                            Notification 8 A new post has been made in the group you follow.
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="ResetPassword" class="usertab-section">
        <img src="img/white-bg.jpg" alt="bg"> 
            <div class="infotab-section">
                <div class="user-content">
                    <div class="user-column">
                        <img src="img/JohnDoe.jpg" alt="John Doe"><br>
                        <span>John Doe</span><br>
                        <span>JohnDoe@gmail.com</span>
                    </div>
                    <div class="profile-info">
                        <table>
                            <tr>
                                <td>Old Password</td>
                                <td><input type="password" class="resetpassword-holder" placeholder="**********"></td>
                            </tr>
                            <tr>
                                <td>New Password</td>
                                <td><input type="password" class="resetpassword-holder" placeholder="**********"></td>
                            </tr>
                            <tr>
                                <td>Confirm Password</td>
                                <td><input type="password" class="resetpassword-holder" placeholder="**********"></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </section>


        <section id="Setting" class="usertab-section">
        <img src="img/white-bg.jpg" alt="bg"> 
            <div class="infotab-section">
                <div class="user-content">
                    <div class="user-column">
                        <img src="img/JohnDoe.jpg" alt="John Doe"><br>
                        <span>John Doe</span><br>
                        <span>JohnDoe@gmail.com</span>
                    </div>
                    <div class="profile-info">
                        <table>
                            <tr>
                                <td>Username</td>
                                <td>Setting</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>JohnDoe@gmail.com</td>
                            </tr>
                            <tr>
                                <td>Email Verification</td>
                                <td>Pending</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </section>


        <section id="Activity" class="usertab-section">
        <img src="img/white-bg.jpg" alt="bg"> 
            <div class="infotab-section">
                <div class="user-content">
                    <div class="user-column">
                        <img src="img/JohnDoe.jpg" alt="John Doe"><br>
                        <span>John Doe</span><br>
                        <span>JohnDoe@gmail.com</span>
                    </div>
                    <div class="container-activity">
                        <div class="accordion">
                            <div class="accordion-item">
                                <button id="accordion-button-1" aria-expanded="false">
                                    <span class="accordion-title">Chat Activity</span>
                                    <span class="icon" aria-hidden="true"></span>
                                </button>
                                <div class="accordion-content">
                                    <span class="notification-item">You have been kicked out of the group.</span><br>
                                    <span class="notification-item">Your request has been approved.</span><br>
                                    <span class="notification-item">New comment on your post.</span><br>
                                    <span class="notification-item">You have a new follower.</span><br>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <button id="accordion-button-2" aria-expanded="false">
                                    <span class="accordion-title">Account Activity</span>
                                    <span class="icon" aria-hidden="true"></span>
                                </button>
                                <div class="accordion-content">
                                    <span class="notification-item">You have been kicked out of the group.</span><br>
                                    <span class="notification-item">Your request has been approved.</span><br>
                                    <span class="notification-item">New comment on your post.</span><br>
                                    <span class="notification-item">You have a new follower.</span><br>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <button id="accordion-button-3" aria-expanded="false">
                                    <span class="accordion-title">Forum Activity</span>
                                    <span class="icon" aria-hidden="true"></span>
                                </button>
                                <div class="accordion-content">
                                    <span class="notification-item">You have been kicked out of the group.</span><br>
                                    <span class="notification-item">Your request has been approved.</span><br>
                                    <span class="notification-item">New comment on your post.</span><br>
                                    <span class="notification-item">You have a new follower.</span><br>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <button id="accordion-button-4" aria-expanded="false">
                                    <span class="accordion-title">Team Favaurite Activity</span>
                                    <span class="icon" aria-hidden="true"></span>
                                </button>
                                <div class="accordion-content">
                                    <span class="notification-item">You have been kicked out of the group.</span><br>
                                    <span class="notification-item">Your request has been approved.</span><br>
                                    <span class="notification-item">New comment on your post.</span><br>
                                    <span class="notification-item">You have a new follower.</span><br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
            const buttons = document.querySelectorAll('.accordion-item button');
            buttons.forEach(button => {
                button.addEventListener('click', () => {
                    const expanded = button.getAttribute('aria-expanded') === 'true';
                    buttons.forEach(btn => {
                        if (btn !== button) {
                            btn.setAttribute('aria-expanded', 'false');
                            btn.nextElementSibling.style.maxHeight = null;
                            btn.nextElementSibling.style.opacity = '0';
                        }
                    });
                    // Toggle the clicked accordion item
                    button.setAttribute('aria-expanded', expanded ? 'false' : 'true');
                    const content = button.nextElementSibling;
                    content.style.maxHeight = expanded ? null : content.scrollHeight + 'px';
                    content.style.opacity = expanded ? '0' : '1';
                });
            });
        });
        </script>
        <script src="js/usertab.js"></script>
    </div>
</x-layout>