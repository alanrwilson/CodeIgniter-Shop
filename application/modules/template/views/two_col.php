<html>

<div style="background-color: #fff; color: #000;">

	

	<div style="background-color: blue; width: 990px; height: 100px;">

		<h1>Two Column Layout</h1>

	</div>

	<div style="word-spacing: -4">
	

		<div style="word-spacing: 0; background-color: grey; width: 150px; height: 800px;display: inline-block; vertical-align: top; margin: 0px; padding:  10px">

			<div style="color: #fff; border-bottom: 2px solid #fff">

				<h1 >Nav</h1>

			</div>

			<div style="color: #fff">

					<p>Left Nav
					</p>

			</div>

		</div>

		<div style="word-spacing: 0; background-color: black; width: 800px; height: 800px; display: inline-block; vertical-align: top; text-align: left; padding:  10px;margin: 0px;">

			<div style="color: #fff; border-bottom: 2px solid #fff">

				<h1 >Content</h1>

			</div>

			<div style="color: #fff">

					<p > 
					<?php $this->load->view($module.'/'.$view_file);?>	
				</p>

			</div>

		</div>

	</div>

</div>

</html>
