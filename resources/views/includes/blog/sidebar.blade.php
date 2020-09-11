				<div class="col-md-4">
					<!-- social widget -->
					<div class="aside-widget">
						<div class="section-title">
							<h2 class="title">Social Media</h2>
						</div>
						<div class="social-widget">
							<ul>
								<li>
									<a href="#" class="social-facebook">
										<i class="fa fa-facebook"></i>
										<span>21.2K<br>Followers</span>
									</a>
								</li>
								<li>
									<a href="#" class="social-twitter">
										<i class="fa fa-twitter"></i>
										<span>10.2K<br>Followers</span>
									</a>
								</li>
								<li>
									<a href="#" class="social-google-plus">
										<i class="fa fa-google-plus"></i>
										<span>5K<br>Followers</span>
									</a>
								</li>
							</ul>
						</div>
					</div>
					<!-- /social widget -->

					<!-- category widget -->
					<div class="aside-widget">
						<div class="section-title">
							<h2 class="title">Categories</h2>
						</div>
						<div class="category-widget">
							<ul>
								@foreach ($categories as $category)
									<li><a  href="{{ route('category', $category->slug) }}">{{ $category->name }}<span>{{ $category->post->count() }}</span></a></li>
								@endforeach
							</ul>
						</div>
					</div>
					<!-- /category widget -->

					<!-- newsletter widget -->
					<div class="aside-widget">
						<div class="section-title">
							<h2 class="title">Newsletter</h2>
						</div>
						<div class="newsletter-widget">
							<form>
								<p>Nec feugiat nisl pretium fusce id velit ut tortor pretium.</p>
								<input class="input" name="newsletter" placeholder="Enter Your Email">
								<button class="primary-button">Subscribe</button>
							</form>
						</div>
					</div>
					<!-- /newsletter widget -->

					<!-- post widget -->
					<div class="aside-widget">
						<div class="section-title">
							<h2 class="title">Popular Posts</h2>
							
						</div>
						@foreach ($populars as $popular)
							<!-- post -->
							<div class="post post-widget">
								<a class="post-img" href="{{ route('post', $popular->slug) }}">
									@foreach ($thum as $item)
										@if ($item->post_id == $popular->id)
										<img src="{{ asset('storage/'.$item->s) }}" alt="thumbnail">
										@endif
									@endforeach
								</a>
								<div class="post-body">
									<div class="post-category">
										@foreach ($categories as $category)
										@if ($popular->category_id == $category->id)
										<a style="color: #ee4266;" href="{{ route('post', $category->slug) }}">{{ $category->name }}</a>
										@endif
										@endforeach
									</div>
									<h3 class="post-title"><a href="{{ route('post', $popular->slug) }}">{{ $popular->title }}</a></h3>
								</div>
							</div>
							<!-- /post -->
						@endforeach

						{{-- <!-- post -->
						<div class="post post-widget">
							<a class="post-img" href="blog-post.html"><img src="{{ asset('frontend/img/widget-2.jpg') }}" alt=""></a>
							<div class="post-body">
								<div class="post-category">
									<a href="category.html">Technology</a>
									<a href="category.html">Lifestyle</a>
								</div>
								<h3 class="post-title"><a href="blog-post.html">Mel ut impetus suscipit tincidunt. Cum id ullum laboramus persequeris.</a></h3>
							</div>
						</div>
						<!-- /post -->

						<!-- post -->
						<div class="post post-widget">
							<a class="post-img" href="blog-post.html"><img src="{{ asset('frontend/img/widget-4.jpg') }}" alt=""></a>
							<div class="post-body">
								<div class="post-category">
									<a href="category.html">Health</a>
								</div>
								<h3 class="post-title"><a href="blog-post.html">Postea senserit id eos, vivendo periculis ei qui</a></h3>
							</div>
						</div>
						<!-- /post -->

						<!-- post -->
						<div class="post post-widget">
							<a class="post-img" href="blog-post.html"><img src="{{ asset('frontend/img/widget-5.jpg') }}" alt=""></a>
							<div class="post-body">
								<div class="post-category">
									<a href="category.html">Health</a>
									<a href="category.html">Lifestyle</a>
								</div>
								<h3 class="post-title"><a href="blog-post.html">Sed ut perspiciatis, unde omnis iste natus error sit</a></h3>
							</div>
						</div>
						<!-- /post --> --}}
					</div>
					<!-- /post widget -->
				</div>