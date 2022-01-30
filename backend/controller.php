<?php 
class Controller {
    private $conn;

    public function __construct()
    {
        require("config.php");
    }

    // DISPLAY ALL MOVIES
    public function show_films()
    {
        $query = "SELECT * FROM film";

        $stm = $this->conn->prepare($query);
        $stm->execute();
        $result = $stm -> fetchAll(PDO::FETCH_OBJ);
        
        foreach($result as $i)
        {
            ?>
            <a href="frontend/details.php?id=<?php echo $i->id?>" class="movie-item">
                <img src="images/movies/<?php echo $i->image?>" alt="">
                <div class="movie-item-content">
                    <div class="movie-item-title">
                        <?php echo $i->title;?>
                    </div>
                    <div class="movie-infos">
                        <div class="movie-info">
                            <i class="bx bxs-star"></i>
                            <span>9.5</span>
                        </div>
                        <div class="movie-info">
                            <i class="bx bxs-time"></i>
                            <span><?php echo $i->duration ?>mins</span>
                        </div>
                        <div class="movie-info">
                            <span>HD</span>
                        </div>
                        <div class="movie-info">
                            <span><?php echo $i->ageLimit?>+</span>
                        </div>
                    </div>
                </div>
            </a>
        <?php
        }
    }

    // SHOW ONE MOVIE WITH DETAILS
    public function show_details()
    {
        $id = $_GET['id'];
        
        if($id != null){
            $query = "SELECT * FROM film, genre, filmhall, language
                    WHERE $id = film.id AND film.genreId = genre.id 
                    AND $id= filmhall.filmId
                    AND film.languageId = language.id";
            $stm = $this->conn->prepare($query);
            //$stm->bindparam(":id", $id);

            if($stm->execute() == true)
            {
                $i =$stm->fetch(PDO::FETCH_OBJ);
                $this->display_details($i);
            }
        }
    }

    public function find_film()
    {
        $search = $_GET['search'];

        if ($search != null){
            $zoek = "%".$_GET['search']."%";
            $query = "SELECT * FROM film, genre 
            WHERE title LIKE :zoek 
            AND film.genreId = genre.id";
            
            $stm = $this-> conn-> prepare($query);
            $stm->bindparam(":zoek", $zoek);

            if($stm->execute() == true)
            {
                $i =$stm->fetch(PDO::FETCH_OBJ);
                $this->display_details($i);
            }
        }
    }


    private function display_details($i)
    {
        ?> 
         <div class='details-container'>
            
            <input type='hidden' name='txtTitle' value='<?php echo $i->title;?>'>
            <input type='hidden' name='txtDate' value='<?php echo $i->date;?>'>
            <input type='hidden' name='txtPrice' value='<?php echo $i->price;?>'>

            <div class='section-header'>
                <div class="col"><?php echo  $i->title;?></div>
            </div>
            <div class='trailer'>
                <iframe width='1000' height='515'
                src='<?php echo  $i->trailer;?>'></iframe>
            </div>
            <div class='poster'>
                <img width='300' src='../images/movies/<?php echo $i->image;?>'>
            </div>
            <div class='genre'>
                <?php echo $i->genre_name;?>
            </div>
            <div class='rel-date'>
                Releasedate: <?php echo $i->releasedate;?>
            </div>
            <div class='cin-date'>
                Cinemadate: <?php echo  $i->date;?>
            </div>
            <div class="description">
                <?php echo $i->description?>
            </div>
            <div class='age-limit'>
                Age limit: <?php echo  $i->ageLimit;?>
            </div>
            <div class='language'>
                Language: <?php echo  $i->shortcut;?>
            </div>
            <div class='btn btn-hover buy'>
                <span class='select_seat' #id="select_seat" onclick="display_seats()"> 
                Buy ticket
                </span>
            </div>
            <div class='duration'>
                <i class='bx bxs-time'></i><?php echo  $i->duration.' min'."</div></div>";
            
    }


    // DISPLAY RESERVATION SEATS
    public function display_seats()
    {
        $query = "SELECT distinct(row), seat FROM seat";
        $stm = $this->conn->prepare($query);
        $stm->execute();
        $result = $stm -> fetchAll(PDO::FETCH_OBJ);
        $list = array_chunk($result, 10);
        $i=1;
        
        foreach($list as $v)
        {
            ?>            
            <?php
            echo "<div class='row $i'>";

            foreach($v as $item)
            {
                ?>

                <div class="seat_container" id="seat_container">
                    <div class="seat" id="seat">
                        <?php echo $item->seat;?></li>
                        <input type="checkbox" name="seatNo" id="checkbox" class="checkbox <?php echo $i?>" value="<?php echo $item->seat;?>">
                        <input type="checkbox" name="rowNo" id="checkbox" class="checkbox" value="<?php echo $item->row;?>">
                    </div>
                </div>

                <?php 
            }
            echo "<br></div>";
            $i++;
        }
    }

    public function buy_ticket()
    {
        require('order_controller.php');
        $order_contr = new Order_controller();
        $order_contr->add_to_basket();
    }
}
?>
