<?php
$message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
$info = isset($_SESSION['info']) ? $_SESSION['info'] : '';
$warning = isset($_SESSION['warning']) ? $_SESSION['warning'] : '';
$danger = isset($_SESSION['danger']) ? $_SESSION['danger'] : '';
if($message || $info || $warning || $danger){
    echo "<div style='clear:both;height: 10px;'></div>";
}
if($message)
{
    unset($_SESSION['message']);
    ?>
    <div class="alert alert-success">
        <i class="fa fa-check" aria-hidden="true"></i> <?php echo $message;?>
    </div>
    <?php
}

if($info)
{
    unset($_SESSION['info']);
    ?>
    <div class="alert alert-info">
        <i class="fa fa-info" aria-hidden="true"></i> <?php echo  $info;?>
    </div>
    <?php
}

if($warning)
{
    unset($_SESSION['warning']);
    ?>
    <div class="alert alert-warning">
        <i class="fa fa-warning" aria-hidden="true"></i> <?php echo $warning;?>
    </div>
    <?php
}

if($danger)
{
    unset($_SESSION['danger']);
    ?>
    <div class="alert alert-danger">
        <strong>Danger</strong> <?php echo $danger;?>
    </div>
    <?php
}
?>