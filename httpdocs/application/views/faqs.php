<?php require Kohana::find_file('views', 'header'); ?>
<div id="subcontainer">
	<div id="subimg">
		<p>
			<span>Lake Powell Jet Ski and Watercraft Rentals! H2O&ndash;Zone is Lake Powell&rsquo;s &#35;1 source for watercraft rentals and
			repairs offering great rates and friendly service. Locally owned and operated for over 10 years.<br/><br/>
			At H20-Zone, we always have a wide variety of equipment available for rent with rates to serve every lifestyle.
			Our equipment is carefully inspected and serviced to ensure they are ready for you! Our shop is located in Page,
			Arizona — only moments away from beautiful Lake Powell.<br/><br/>
			Drop by, give us a call or make your reservation online and you'll see why we remain
			the best personal watercraft rental service company in Northern Arizona!</span>
		</p>
	</div>
	<div id="subimgrotate"><?php echo HTML::image('images/img_subpage_03.jpg', array('width' => 949, 'height' => 195, 'alt' => '')); ?></div>
</div>
<div id="main-body">
	<div id="left">
		<div id="leftText">
			<?php echo HTML::anchor(Route::get('static')->uri(array('page' => '')), 'Home'); ?> &nbsp;&gt;&nbsp; Rental FAQs
			<br/><br/>

			<?php echo HTML::image('images/ttl_rentalfaqs.gif', array('width' => 92, 'height' => 17, 'alt' => '', 'class' => 'subttl')); ?>

			<h6>Do you offer half-day rates?</h6>
			<p>Unfortunately at this time we only offer full day rentals.</p>

			<h6>Does the watercraft come on a trailer or do we rent one?</h6>
			<p>A trailer is provided at no extra charge.</p>

			<h6>Can you launch and retrieve our rental machines?</h6>
			<p>
				No. Due to NPS regulations, you must launch and retrieve the rental equipment yourself.
				For your convenience, we rent vehicles capable of towing. More information and rates are available when you make your
				online reservation.
			</p>

			<h6>What if I only have a rental car?</h6>
			<p>
				We offer a vehicle for rent which can be used to tow your rental watercraft to the lake.
				More information and rates are available when you make your online reservation.
			</p>

			<h6>Can fuel cans or camping gear be transported on the PWC?</h6>
			<p>
				Transportation of equipment is possible but should be made at your own discretion.
				Damages to the machines caused by improper care will result in additional charges should they occur.
			</p>

			<h6>What are your rental policies?</h6>
			<p>
<?php if (Kohana::config('app.pwc_deposit')) : ?>
				A damage deposit of $<?php echo Num::format(Kohana::config('app.pwc_deposit'), 2); ?> is required for each personal watercraft rented.
				This deposit will be charged the day of pickup and will be returned to you when the machine is returned undamaged.<br/><br/>
<?php endif; ?>
				All reservations are held with a Visa, MasterCard or Discover card number.
				A one-day rental fee per reserved watercraft will be charged if a cancellation occurs 7 days or less prior to reservation date.
				Your credit card will be charged for the entire rental period if a &ldquo;no-show&rdquo; or &ldquo;cancellation&rdquo; occurs
				the day of the reservation.
			</p>

			<h6>Is water skiing behind a PWC permitted?</h6>
			<p>
				Yes, and our rental equipment meet the requirements. All watercraft towing skiers must be capable of seating three people.
				In addition to the operator, an observer (at least eight years old) must be on board to watch and communicate with the skier.
				The observer must display an international orange flag at least 12 inches square when the skier is down in the water.
			</p>

			<h6>Is cash an excepted form of payment for my rental?</h6>
			<p>
				Cash is accepted for the price of the rental, but a credit card is required for security deposit reasons in the event that
				damage occurs during your rental period.
			</p>

			<h6>What year are your machines?</h6>
			<p>
				Our machines are new and non-current models, in excellent running condition.
				Visit the <?php echo HTML::anchor(Route::get('static')->uri(array('page' => 'rates-models')), 'rental page'); ?>
				to view our current fleet.
			</p>

			<h6>What time are rentals due back?</h6>
			<p>Our pickup time is 8:00am and return time is 5:00pm on your return date.</p>

			<h6>How often will I need to fill the machine with gasoline?</h6>
			<p>
				The machines are full when you pick them up, and must be returned full to avoid extra charges.
				A full tank of fuel will run approximately 3 to 6 hours depending on fuel capacity and length/speed of ride.
			</p>

			<h6>Are gas cans or life jackets provided?</h6>
			<p>Yes. For your convenience, we provide life jackets and gas cans at no extra charge.</p>

			<h6>Do you provide a vehicle service for the launch and retrieval of rentals?</h6>
			<p>
				Yes, we provide rental vehicles at the rate of $45 per day, allowing you to keep the vehicle all day without returning
				until the check in time of 5:00pm.
				More information and rates are available when you make your online reservation.
			</p>

			<h6>Can personal watercraft be operated at night, if we have lights?</h6>
			<p>
				No. Current laws do not permit personal watercraft to be operated between sunset and sunrise,
				even if they are equipped with navigation lights.
			</p>

			<h6>What types of accessories do you offer for rent?</h6>
			<p>
				We have a wide range of knee boards, water skis, tubes, wake boards and ropes available.
				When making an online reservation, you have the option to include additional accessories.
			</p>

			<h6>What other services do you offer?</h6>
			<p>
				In addition to providing a great rental service, we also repair and diagnose all major brands of watercraft.
				Visit our <?php echo HTML::anchor(Route::get('static')->uri(array('page' => 'boat-services-trailer-sales')), 'services'); ?> page
				for more information.
			</p>
		</div>
	</div>
	<div id="right">
		<div id="rightTextProduct">
			<?php echo HTML::image('images/ttl_operator.gif', array('alt' => 'Operator Requirements', 'width' => 189, 'height' => 17)); ?>
			<h4>ARIZONA</h4>

			<div id="highlightleft">
				<strong>OPERATION AGE</strong><br/>
				Arizona prohibits anyone under 12 years of age from operating any craft with an 8-horsepower or larger motor, except:
				<div class="customBullets">
					<ul>
						<li>In emergencies</li>
						<li>With a passenger 18 years of age or older</li>
					</ul>
				</div>
			</div>
			<a href="http://www.azgfd.gov/" target="_blank"><?php echo HTML::image('images/promo_azgf.png', array('width' => 84, 'height' => 83, 'alt' => 'Arizona Game & Fish', 'class' => 'right')); ?></a>
			<br/>

			<strong>BOATING EDUCATION</strong><br/>
			The Arizona Game and Fish Department offers certified courses in boating education.
			For more information, visit their website:
			<a href="http://www.azgfd.gov/i_e/edits/boating_education.shtml" target="_blank">Arizona Game and Fish</a>
			Or call, (602) 789-3235 for the most current information or to register.<br/>

			<h4>UTAH</h4>

			<div id="highlightleft">
				<strong>OPERATION AGE</strong><br/>
				Persons 12 to 17 years of age may operate a PWC (Jet Ski, Waverunner, Sea Doo, etc.) alone, provided:
				<div class="customBullets">
					<ul>
						<li>
							The operator completes a boating education course approved by Utah State Parks and has in their possession
							the certificate issued by the course provider.
						</li>
						<li>
							In addition, to the education requirement, operators 12-15 years of age must be under direct supervision
							(within sight at a distance in which visual contact is maintained by the adult responsible for the young boat operator)
							of a person at least 18 years of age.
						</li>
 						<li>
 							A person less than 18 years of age who has not met the above requirements may not operate a PWC
 							unless accompanied on board by a person at least 18 years of age.
 						</li>
 					</ul>
 				</div>
 			</div>

			<br/>
			<a href="http://stateparks.utah.gov/boating/pwc" target="_blank"><?php echo HTML::image('images/promo_utsp.gif', array('width' => 73, 'height' => 92, 'alt' => 'Utah State Parks', 'class' => 'right')); ?></a>
			<strong>YOUTH PWC<br/>EDUCATION COURSE</strong>
			<br/>
			For <a href="http://stateparks.utah.gov/boating/pwc" target="_blank">Utah PWC course information</a>,
			contact Utah State Parks and Recreation's boating hotline by calling<br/>
			(866) 764-2628.
		</div>
	</div>
	<br style="clear: both"/>
</div>
<?php require Kohana::find_file('views', 'footer'); ?>
