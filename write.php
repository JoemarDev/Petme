

<?php require_once 'template.php'; ?>

<?php function getTitle(){
	echo "PETME | HOME";
} ?>

<?php function getContent() { ?>


	<?php if (empty($_SESSION['access_token'])) : ?>
		<div class="w-100 py-5 text-center">
		     <img src="assets/images/icon/dog.svg" alt="" class="img-fluid" style="object-fit: contain;">
		     <h2>Sorry we can't find what you looking for :(</h2>
		</div>	

	<?php else : ?>

	
	<style type="text/css">
		.blog-write input{
			border:none;
			border: 1px solid #ccc;
			border-radius: 5px;
			width: 100%;
			padding: 5px;
			font-size: 14px;
		}	

		.blog-write-table td {
			border-bottom :1px solid #eee;
		}

		.w-15 {
			width: 15%;
		}

		.w-85 {
			width: 85%;
		}
	</style>

	<section class="page-title" style="background-image:url(assets/images/background/7.jpg)">
        <div class="container">
            <div class="clearfix">
                <div class="float-left">
                    <h1>Write Post</h1>
                </div>
                <div class="float-right bread-parent">
                    <ul class="page-breadcrumb">
                        <li><a href="index.php">Home</a></li>
                         <li><a href="blog.php">Blog</a></li>
                        <li>Write</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

	<div class="container blog-write mt-4">
		<div class="card p-3">
			<form action="lib/blog-endpoint/save-blog.php" method="post"  enctype="multipart/form-data">
				<table class="blog-write-table">
					<tr>
						<td class="w-15 px-3 py-2 text-left"><h2><strong>Blog Post</strong></h2></td>
						<td class="w-85 px-3 py-2"></td>
					</tr>
					<tr>
						<td class="w-15 px-3 py-2 text-left"><strong>Blog Title</strong></td>
						<td class="w-85 px-3 py-2"><input required type="text" name="blog-title"></td>
					</tr>
					<tr>
						<td class="w-15 px-3 py-2 text-left"><strong>Blog Description</strong></td>
						<td class="w-85 px-3 py-2"><input required type="text" name="blog-description" maxlength="158"></td>
					</tr>
					<tr>
						<td class="w-15 px-3 py-2 text-left"><strong>Main Image</strong></strong></td>
						<td class="w-85 px-3 py-2"><input type="file" accept="image/x-png,image/gif,image/jpeg" name="blog-image"></td>
					</tr>
				</table>
				<div class="form-holder px-3 mt-3">
					<textarea id="blog-form" name="blog-content" required></textarea>
				</div>
				<table class="blog-write-table w-100">
					<tr>
						<td class="w-15 px-3 py-2 text-left"></td>
						<td class="w-85 px-3 py-2">
							
						</td>
					</tr>
					<tr>
						<td class="w-15 px-3 py-2 text-left"><strong>Related Links</strong></td>
						<td class="w-85 px-3 py-2">
							<input type="text" class="mt-2 w-100" name="blog-link-1" placeholder="https://">
							<input type="text" class="mt-2 w-100" name="blog-link-2" placeholder="https://">
						</td>
					</tr>
				
				</table>
				<div class="button-holder px-3 mt-4">
					<div class="float-left w-50 px-2">
						<button class="w-100 theme-btn btn-style-three">CANCEL</button>
					</div>
					<div class="float-right w-50 px-2">
						<button class="w-100 theme-btn btn-style-two" type="submit">SUBMIT </button>
					</div>
				</div>
			</form>


		</div>

	    <hr>
	
				
	</div>

	<?php endif; ?>	
	
	<?php require_once 'partials/footer/footer.php'; ?>

<?php } ?>


	<script type="text/javascript" src="assets/js/image.min.js"></script>
	<script type="text/javascript">

		$(document).ready(function() {
			new FroalaEditor('#blog-form',{
				heightMin: 500,
				imageUploadURL: 'lib/blog-endpoint/editor-image-endpoint.php',
				imageUploadParams: {
			       id: 'file'
			    },
			    events : {
			    	'image.removed' : function($img) {
			    		console.log('asdjlbasdjbklasdbjkasd')
			    		let link = $img.attr('src');
			    		$.ajax({
			    			url : 'lib/blog-endpoint/editor-remove-image-endpoint.php',
			    			method : 'POST',
			    			data : {'link' : link }
			    		})
			    	}
			    },
			    key : "AV:4~?3xROKLJKYHROLDXDR@d2YYGR_Bc1A8@5@4:1B2D2F2F1?1?2A3@1C1",

			});

		});



	    $('.header-menu').find('li').eq(0).addClass('active');
	</script>
