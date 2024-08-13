    <x-layout>
        <div class="main-container">
            <section>
                <div class="contactbanner-row">
                    <div class="contact-banner">
                        <img src="img/contact.png" alt="contact-banner">
                        <div class="overlay"></div>
                        <div class="text-container">
                            <h1 class="main-text">Contact us</h1>
                            <p class="sub-text">Need help with something? Feel free to ask</p>
                        </div>
                    </div>
                </div>
            </section>
            <section>
                <div class="contactinfo-row">
                    <div class="column">
                        <div class="circle">
                                <div class="symbol">
                                <i class="bi bi-telephone-fill" style="font-size: 3rem; color: blue; "></i>
                                </div>
                        </div>
                        <div class="info">
                            <h1> OUR NUMBER </h1>
                            <p>01x-xxxxxxxx</p>
                            <p>01x-xxxxxxxx</p>
                        </div>
                        <div class="link-info" >
                            <a href="#mail">CALL US</a>
                        </div>
                    </div>
                    <div class="column">
                        <div class="circle">
                                    <div class="symbol">
                                        <i class="bi bi-geo-alt-fill" style="font-size: 3rem; color:red;"></i>
                                    </div>
                            </div>
                            <div class="info">
                                <h1> OUR LOCATION </h1>
                                <p>1234 Arena Lane, Rink City, </p>
                                <p> HC 56789</p>
                            </div>
                            <div class="link-info" >
                                <a href="#mail">E-MAIL US </a>
                            </div>
                        </div>
                    <div class="column">
                        <div class="circle">
                                <div class="symbol">
                                    <i class="bi bi-envelope-fill" style="font-size: 3rem; color: white;"></i>
                                </div>
                            </div>
                            <div class="info">
                                <h1> OUR E-MAIL </h1>
                                <p>arenahoki@gmail.com</p>
                                <p>sturtsy@hoki.com</p>
                            </div>
                            <div class="link-info" >
                                <a href="#mail">E-MAIL US</a>
                            </div>
                        </div>
                    </div>
            </section>
        </div>
    <div class="message">
        <div class="text-container2">
            <p class="sub-text2">HAVE QUESTION?</p>
            <h1 class="main-text2">DROP US A MESSAGE</h1>
        </div>
        <div class="message-container">
        <form action="action_page.php">
            <div class="input-container">
                <input type="text" id="phone" name="name" placeholder="NAME">
                <input type="text" id="phone" name="phone" placeholder="PHONE NUMBER">
                <input type="text" id="email" name="email" placeholder="E-MAIL">
            </div>
            <textarea id="subject" name="subject" placeholder="Message" style="height:200px"></textarea>
            <input type="submit" value="Submit">
        </form>
        </div>
    </div>
    </x-layout>

