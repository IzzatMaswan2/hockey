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
        <img src="img/grass-bg.jpg" alt="bg">
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
        <img src="img/grass-bg.jpg" alt="bg"> 
            <div class="infotab-section">
                <div class="user-content">
                    <div class="user-column">
                        <img src="img/JohnDoe.jpg" alt="John Doe"><br>
                        <span>John Doe</span><br>
                        <span>JohnDoe@gmail.com</span>
                    </div>
                    <div class="scrollbox">
                        <table class="notification-table">
                            <tbody>
                                <tr>
                                    <td><i class="bi bi-bell-fill"></i></td>
                                    <td>Notification 1: A new event has been added to the community calendar</td>
                                </tr>
                                <tr>
                                    <td><i class="bi bi-bell-fill"></i></td>
                                    <td>Notification 2: The content has been updated.</td>
                                </tr>
                                <tr>
                                    <td><i class="bi bi-bell-fill"></i></td>
                                    <td>Notification 3: The new article has been published.</td>
                                </tr>
                                <tr>
                                    <td><i class="bi bi-bell-fill"></i></td>
                                    <td>Notification 4: You have a new friend request.</td>
                                </tr>
                                <tr>
                                    <td><i class="bi bi-bell-fill"></i></td>
                                    <td>Notification 5: Someone liked your recent post</td>
                                </tr>
                                <tr>
                                    <td><i class="bi bi-bell-fill"></i></td>
                                    <td>Notification 6: Your registration for the event was successful.</td>
                                </tr>
                                <tr>
                                    <td><i class="bi bi-bell-fill"></i></td>
                                    <td>Notification 7: A new login to your account was detected from an unrecognized device.</td>
                                </tr>
                                <tr>
                                    <td><i class="bi bi-bell-fill"></i></td>
                                    <td>Notification 8: A new post has been made in the group you follow.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                </div>
            </div>
        </section>

        <section id="ResetPassword" class="usertab-section">
        <img src="img/grass-bg.jpg" alt="bg"> 
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
        <img src="img/grass-bg.jpg" alt="bg"> 
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
                                <td>
                                    Theme
                                </td>
                                <td> Dark Mode
                                    <label class="switch">
                                        <input type="checkbox">
                                        <span class="slider round"></span>
                                    </label>
                                    Light Mode
                                </td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>
                                    <select name="language" id="language" >
                                        <option value="" selected="selected">Language</option>
                                        <option value="my">Malaysia</option>
                                        <option value="en">English</option>
                                        <option value="es">Spanish</option>
                                        <option value="fr">French</option>
                                        <option value="de">German</option>
                                        <option value="it">Italian</option>
                                        <option value="pt">Portuguese</option>
                                        <option value="zh">Chinese</option>
                                        <option value="ja">Japanese</option>
                                        <option value="ko">Korean</option>
                                        <option value="ar">Arabic</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Help Center</td>
                                <td>Need help? Visit our FAQ for answers to common questions <a href="/">F.A.Q</a></td>
                            </tr>
                            <tr>
                                <td>Delete Account</td>
                                <td>Are you sure you want to delete your account? 
                                    This action cannot be undone. <a href="{{'delete'}}" style="color: red">Delete</a></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </section>


        <section id="Activity" class="usertab-section">
        <img src="img/grass-bg.jpg" alt="bg"> 
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
                                    <table class="notification-table">
                                        <tbody>
                                            <tr>
                                                <td class="notification-date">17-08-2024</td>
                                                <td class="notification-text">You have been kicked out of the group.</td>
                                            </tr>
                                            <tr>
                                                <td class="notification-date">18-08-2024</td>
                                                <td class="notification-text">Your request has been approved.</td>
                                            </tr>
                                            <tr>
                                                <td class="notification-date">19-08-2024</td>
                                                <td class="notification-text">New comment on your post.</td>
                                            </tr>
                                            <tr>
                                                <td class="notification-date">20-08-2024</td>
                                                <td class="notification-text">You have a new follower.</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <button id="accordion-button-2" aria-expanded="false">
                                    <span class="accordion-title">Account Activity</span>
                                    <span class="icon" aria-hidden="true"></span>
                                </button>
                                <div class="accordion-content">
                                    <table class="notification-table">
                                        <tbody>
                                            <tr>
                                                <td class="notification-date">17-08-2024</td>
                                                <td class="notification-text">You have been kicked out of the group.</td>
                                            </tr>
                                            <tr>
                                                <td class="notification-date">18-08-2024</td>
                                                <td class="notification-text">Your request has been approved.</td>
                                            </tr>
                                            <tr>
                                                <td class="notification-date">19-08-2024</td>
                                                <td class="notification-text">New comment on your post.</td>
                                            </tr>
                                            <tr>
                                                <td class="notification-date">20-08-2024</td>
                                                <td class="notification-text">You have a new follower.</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <button id="accordion-button-3" aria-expanded="false">
                                    <span class="accordion-title">Forum Activity</span>
                                    <span class="icon" aria-hidden="true"></span>
                                </button>
                                <div class="accordion-content">
                                    <table class="notification-table">
                                        <tbody>
                                            <tr>
                                                <td class="notification-date">17-08-2024</td>
                                                <td class="notification-text">You have been kicked out of the group.</td>
                                            </tr>
                                            <tr>
                                                <td class="notification-date">18-08-2024</td>
                                                <td class="notification-text">Your request has been approved.</td>
                                            </tr>
                                            <tr>
                                                <td class="notification-date">19-08-2024</td>
                                                <td class="notification-text">New comment on your post.</td>
                                            </tr>
                                            <tr>
                                                <td class="notification-date">20-08-2024</td>
                                                <td class="notification-text">You have a new follower.</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <button id="accordion-button-4" aria-expanded="false">
                                    <span class="accordion-title">Team Favaurite Activity</span>
                                    <span class="icon" aria-hidden="true"></span>
                                </button>
                                <div class="accordion-content">
                                    <table class="notification-table">
                                        <tbody>
                                            <tr>
                                                <td class="notification-date">17-08-2024</td>
                                                <td class="notification-text">You have been kicked out of the group.</td>
                                            </tr>
                                            <tr>
                                                <td class="notification-date">18-08-2024</td>
                                                <td class="notification-text">Your request has been approved.</td>
                                            </tr>
                                            <tr>
                                                <td class="notification-date">19-08-2024</td>
                                                <td class="notification-text">New comment on your post.</td>
                                            </tr>
                                            <tr>
                                                <td class="notification-date">20-08-2024</td>
                                                <td class="notification-text">You have a new follower.</td>
                                            </tr>
                                        </tbody>
                                    </table>
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