<footer class="section">
        <div class="container">
            <div class="row">
                <div class="col-4 col-md-6 col-sm-12"> <!-- MAAKT HET RESPONSIVE -->
                    <div class="content">
                        <a href="#" class="logo">
                            BereKatarzynaMovies
                        </a>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut veniam ex quos hic id nobis beatae earum sapiente! Quod ipsa exercitationem officiis non error illum minima iusto et. Dolores, quibusdam?
                        </p>
                        <div class="social-list">
                            <a href="#" class="social-item">
                                <i class="bx bxl-facebook"></i>
                            </a>
                            <a href="#" class="social-item">
                                <i class="bx bxl-twitter"></i>
                            </a>
                            <a href="#" class="social-item">
                                <i class="bx bxl-instagram"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-8 col-md-6 col-sm-12">
                    <div class="row">
                        <div class="col-3 col-md-6 col-sm-6">
                            <div class="content">
                                <p><b>BereKatarzynaMovies</b></p>
                                <ul class="footer-menu">
                                    <li><a href="#">Over ons</a></li>
                                    <li><a href="#">Events</a></li>
                                    <li><a href="#">Genres</a></li>
                                    <li><a href="#">Contacts</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-3 col-md-6 col-sm-6">
                            <div class="content">
                                <p><b>Browse</b></p>
                                <ul class="footer-menu">
                                    <li><a href="#">Over ons</a></li>
                                    <li><a href="#">Events</a></li>
                                    <li><a href="#">Genres</a></li>
                                    <li><a href="#">Contacts</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-3 col-md-6 col-sm-6">
                            <div class="content">
                                <p><b>Help</b></p>
                                <ul class="footer-menu">
                                    <li><a href="#">Over ons</a></li>
                                    <li><a href="#">Events</a></li>
                                    <li><a href="#">Genres</a></li>
                                    <li><a href="#">Contacts</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- END FOOTER SECTION -->
    <div class="copyright">
        Copyright 2021 Bere K</a>
    </div>
    <!-- SCRIPT EN JQUERY -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous"></script>
    <script src="style/app.js"></script>
    <script src="../style/app.js"></script>
    <script>
    // NAVIGATE WEBSITE // 
    var url = window.location.href;
    function nav_home(){
        if(url.includes('frontend'))
        {
            window.location.replace('../');
        }
        else {
            window.location.replace('index.php');
        }
    }

    function nav_order(){
        if(url.includes('frontend'))
        {
            window.location.replace('order.php');
        }
        else {
            window.location.replace('frontend/order.php');
        }
    }

    function nav_login(){
        if(url.includes('frontend'))
        {
            window.location.replace('login.php');
        }
        else {
            window.location.replace('frontend/login.php');
        }
    }

    function nav_user() {
        if(url.includes('frontend'))
        {
            window.location.replace('dashboard.php?user=<?php echo $_SESSION['login']?>&id=<?php echo $_SESSION['id']?>');
        }
        else {
            window.location.replace('frontend/dashboard.php?user=<?php echo $_SESSION['login']?>&id=<?php echo $_SESSION['id']?>');
        }
    }

    function nav_genre(){
        if(url.includes('frontend'))
        {
            window.location.replace('genre.php?display=genre');
        }
        else {
            window.location.replace('frontend/genre.php?display=genre');
        }
    }

    function display_seats()
    {
        var x = document.getElementById('seats_container');
        
        if(x.style.display  !== "flex")    {
            x.style.display = "flex";
            x.target.classList.toggle('open');
        }
        else {
            x.style.display = "none";
        }
    }
    
    const count = document.getElementById('count');
    var val = 0; 
    seats_container.addEventListener('click', e => {
        if(e.target.classList.contains('seat') && 
        !e.target.classList.contains('occupied')) {
            e.target.classList.toggle('selected');

            
            document.getElementById('value').value = ++val;
            // var dif = seats + val;
            // console.log(dif);

        updateSelected(e);
        }
    });

    function updateSelected(e) {
        
        const selected = document.querySelectorAll('.selected');

        if(e.target.classList.contains('selected')){
            $('.selected > input[name=seatNo]').attr('checked', true);
            $('.selected > input[name=rowNo]').attr('checked', true);
        }
    }
    </script>
</body>
</html>