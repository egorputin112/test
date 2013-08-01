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
			<?php echo HTML::anchor(Route::get('static')->uri(array('page' => '')), 'Home'); ?> &nbsp;&gt;&nbsp; Terms of Use
			<br/><br/>

			<?php echo HTML::image('images/ttl_terms.gif', array('width' => 103, 'height' => 16, 'alt' => 'Terms of Use', 'class' => 'subttl')); ?>
            
<h3>Terms</h3>

<p>
	By accessing this web site, you are agreeing to be bound by these 
	web site Terms and Conditions of Use, all applicable laws and regulations, 
	and agree that you are responsible for compliance with any applicable local 
	laws. If you do not agree with any of these terms, you are prohibited from 
	using or accessing this site. The materials contained in this web site are 
	protected by applicable copyright and trade mark law.
</p>

<h3>
	Use License
</h3>

<ol type="a">
	<li>
		Permission is granted to temporarily download one copy of the materials 
		(information or software) on H2O-Zone, Inc.&rsquo;s web site for personal, 
		non-commercial transitory viewing only. This is the grant of a license, 
		not a transfer of title, and under this license you may not:
		
		<ol type="i">
			<li>modify or copy the materials;</li>
			<li>use the materials for any commercial purpose, or for any public display (commercial or non-commercial);</li>
			<li>attempt to decompile or reverse engineer any software contained on H2O-Zone, Inc.'s web site;</li>
			<li>remove any copyright or other proprietary notations from the materials; or</li>
			<li>transfer the materials to another person or "mirror" the materials on any other server.</li>
		</ol>
	</li>
	<li>
		This license shall automatically terminate if you violate any of these restrictions and may be terminated by H2O-Zone, Inc. at any time. Upon terminating your viewing of these materials or upon the termination of this license, you must destroy any downloaded materials in your possession whether in electronic or printed format.
	</li>
</ol>

<h3>
	Disclaimer
</h3>

<ol type="a">
	<li>
		The materials on H2O-Zone, Inc.&rsquo;s web site are provided "as is". H2O-Zone, Inc. makes no warranties, expressed or implied, and hereby disclaims and negates all other warranties, including without limitation, implied warranties or conditions of merchantability, fitness for a particular purpose, or non-infringement of intellectual property or other violation of rights. Further, H2O-Zone, Inc. does not warrant or make any representations concerning the accuracy, likely results, or reliability of the use of the materials on its Internet web site or otherwise relating to such materials or on any sites linked to this site.
	</li>
</ol>

<h3>
	Limitations
</h3>

<p>
	In no event shall H2O-Zone, Inc. or its suppliers be liable for any damages (including, without limitation, damages for loss of data or profit, or due to business interruption,) arising out of the use or inability to use the materials on H2O-Zone, Inc.'s Internet site, even if H2O-Zone, Inc. or a H2O-Zone, Inc. authorized representative has been notified orally or in writing of the possibility of such damage. Because some jurisdictions do not allow limitations on implied warranties, or limitations of liability for consequential or incidental damages, these limitations may not apply to you.
</p>
			
<h3>
	Revisions and Errata
</h3>

<p>
	The materials appearing on H2O-Zone, Inc.&rsquo;s web site could include technical, typographical, or photographic errors. H2O-Zone, Inc. does not warrant that any of the materials on its web site are accurate, complete, or current. H2O-Zone, Inc. may make changes to the materials contained on its web site at any time without notice. H2O-Zone, Inc. does not, however, make any commitment to update the materials.
</p>

<h3>
	Links
</h3>

<p>
	H2O-Zone, Inc. has not reviewed all of the sites linked to its Internet web site and is not responsible for the contents of any such linked site. The inclusion of any link does not imply endorsement by H2O-Zone, Inc. of the site. Use of any such linked web site is at the user's own risk.
</p>

<h3>
	Site Terms of Use Modifications
</h3>

<p>
	H2O-Zone, Inc. may revise these terms of use for its web site at any time without notice. By using this web site you are agreeing to be bound by the then current version of these Terms and Conditions of Use.
</p>

<h3>
	Governing Law
</h3>

<p>
	Any claim relating to H2O-Zone, Inc.&rsquo;s web site shall be governed by the laws of the State of Arizona without regard to its conflict of law provisions.
</p>

<p>
	General Terms and Conditions applicable to Use of a Web Site.
</p>
</div>
	</div>
	<div id="right">
					<?php include('parts/contact-right.php'); ?>
			</div>
	<br style="clear: both"/>
</div>
<?php require Kohana::find_file('views', 'footer'); ?>
