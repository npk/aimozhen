<?php
include "../include/init.php";$pagename = "tag";
include '../view/base/header.php';
$page_size = 23;
$page = isset($_GET['p']) ? intval($_GET['p']) : 1;
$search = urldecode($_GET['s']);
$video = new Video();
$videos = $video->find(array('search' => $search));
$video_count = count($videos);


?>
	<div style="text-align:center; width:100%; color:#AAA">共有 <?=$video_count; ?> 个视频标题含有 “<?=$search; ?>”</div>

<div class="container">
<div class="row"> <div class="span8 breadcrumb"> <a href="/"><?=$sitename?></a> > <a href="#">搜索结果</a> > <a href="#"><?=$search; ?></a></div></div>
    
      <div class="row">
  <div class="span12" style="margin:0"> 
  <?php include HTDOCS_DIR . "/view/base/login.php"; ?>
      <?
				$video = new Video();
				$videos = $video->find(array('order' => 'id desc', 'search' => $search , 'limit' => ($page-1) * $page_size . ', ' . $page_size));

				foreach ($videos as $video) {
					$user = new User($video->userid);
		?>
      <!-- 作品-->
		<?php include HTDOCS_DIR . "/view/base/post.php"; ?>
      <!-- /作品--> 
	<?
		}
	?>
		  </div>
      </div>
      <div class="row"><p style="text-align: center">

<? for ($i=1; $i<=ceil($video_count / $page_size); $i++) { ?>
<a href="/search/?s=<?=$search?>&p=<?=$i?>"><span <? if(($i == $page)||(($i == 1)&&($page == 1))) { ?> class="btn btn-red disabled" <? } else { ?> class="btn btn-red" <? }?>><?=$i?></span></a>

<? }?>

        </p> </div>
    </div> <!-- /上方 -->
<?php
include '../view/base/footer.php';
?>
