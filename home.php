<?php
/*
Template Name: home 
*/
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>video-player</title>
    <?php wp_head();?>
</head>

<body>
    <?php get_header(); ?>

    <main>

        <div class = 'lang'><?php echo do_shortcode('[gtranslate]') ?></div>
        <div class="main__body">
            <div class="main__body__container">
                <h1>Видео</h1>
                <div class="videos">
                <?php
                    global $post;

                    $myposts = get_posts([ 
                        'numberposts'      =>   -1,
                        'category_name'    =>  'videos'
                    ]);

                    if( $myposts ){
                        foreach( $myposts as $post ){
                            setup_postdata( $post );
                            ?>
                                <div class = 'video'>
                                    <?php $videoName = CFS()->get('video'); ?>
                                    <a href="http://www.alexbatya.ffox.site/?page_id=18&videoName=<?php echo $videoName ?>">
                                        <div class="video__body">
                                            <video style = 'background: url("<?php the_post_thumbnail_url() ?>") center / cover no-repeat;' playsinline poster = "<?php the_post_thumbnail_url() ?>" muted id = 'first_player' src="<?php bloginfo('template_url') ?>/assets/img/shortVideos/preview-<?php echo $videoName ?>"  ></video>
                                            <div class = 'time'><?php echo CFS()->get('video_time') ?></div>
                                        </div>
										<div class = 'prevText' ><?php the_title() ?></div>
                                    </a>
                                </div>            
                            <?php 
                        }
                        } else {
                            // Постов не найдено
                        }

                    wp_reset_postdata(); // Сбрасываем $post
                ?>
                </div>
            </div>
        </div>
    </main>    

    <script>
		
		window.addEventListener('DOMContentLoaded', () => {
			const videos = document.querySelectorAll('.video a video');

            let timerIds = {};

            const handleMouseOver = (e) => {
            // Создаем таймер при помощи setTimeout
            // и сохраняем полученный id в timerIds
            // по id тега
                timerIds[e.target.id] = setTimeout(() => {
                // Внутри обработчика через 2000 миллисекунд (2 секунды)
                // запускаем видео
                    e.target.play();
                // и удаляем id из объекта, опять же по id тега
                    delete timerIds[e.target.id];
                }, 1000);
            }

            function hendlonmouseoverMob(e){
				if(e.target.className != 'active'){
					videos.forEach(elem => {
						elem.className = '';
						elem.load();
					})
					e.target.className = 'active'
					e.target.play()	
				}
				else{
					// ничего не происходит
				}
			}

            // Функция обработчик выход за пределы тега курсором
            const handleMouseOut = (e) => {
            // Останавливаем таймер по id тега
                clearTimeout(timerIds[e.target.id]);
            // Удаляем id таймера
                delete timerIds[e.target.id];
            // Ставим видео на паузу
                e.target.load();
            }

            // Функция обработчик остановки видео, но тут все понятно
            const handleVideoEnded = (e) => {
                e.target.load();
                e.target.play();
            }
			
			videos.forEach(elem => {
				elem.addEventListener('mouseover', handleMouseOver)
				elem.addEventListener('mouseout', handleMouseOut)
				elem.addEventListener('touchmove', hendlonmouseoverMob)  
				elem.addEventListener('ended', handleVideoEnded)
			})
		});
		
    </script>

    <?php get_footer(); ?>
    <?php  wp_footer(); ?>
</body>
</html>