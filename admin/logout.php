<?php

session_start();
session_destroy($_SESSION['uid']);
header('location: login.php');