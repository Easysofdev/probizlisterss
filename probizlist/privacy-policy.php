<?php require_once('inc/db_conn.php'); ?>
<?php require 'inc/top-header-home.php'; ?>
<script>
function getAd(c) {
  if (c == "") {
    return false;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
	   if (xmlhttp.readyState == 1){
		document.getElementById("d_ad").innerHTML = "<br /><img src='images/progress-bar.gif' style='width:95%; max-width:350px; border-radius:10px;' />";
	  }
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("d_ad").innerHTML = this.responseText;
		document.getElementById("d_ad").focus();
      }
    };
    xmlhttp.open("GET","inc/ajax_general_processor.php?c="+c+"&origin=home_ad_by_cat",true);
    xmlhttp.send();
  }
}
</script>

<?php require 'inc/main-side-menu.php'; ?>

<div class="main-body" style="background-color:rgba(0,153,0,0.3);">
<div style="margin:auto; width:90%; text-align:left;">
<div style="margin:0; width:100%; line-height:1.5em;">
<div class="pol_top_hd">COMPANY OVERVIEW</div>
<div class="pol_hd">PROBIZLIST</div>
Turning Wheels of Entrepreneurship in Nigeria.
ProBizList is a business and professional listing, directory and classified ads website - an
advertising platform for all businesses and professionals in all States, Cities and localities across
the country.
ProBizList links consumers with businesses with good track record.

<div class="pol_hd">MISSION STATEMENT</div>
Founded in 2021, ProBizList aims to make it easy for all businesses and professionals to project
themselves online easily in reaching to their target audience easily and to make it easy for
people to get tested and trusted business and professional easily.

<div class="pol_hd">LONG DESCRIPTION OF PAGE</div>
What are the value that ProBizList offers consumers - LEADS, LEADS & MORE LEADS
The most valuable benefit we offer our customer is the ability to funnel leads to their business
through our directory website.

<p>ProBizList is that marketing tool that is working 24/7 for your business, showcasing your
business across the State, city and locality.
<div class="pol_hd">What is it we offer</div>
<ul><li>Easy of use</li>
<li>Centralizing marketing efforts</li>
<li>Reducing advertising expenses</li>
<li>Empowering Consumers</li>
</ul>
</p>

<div class="pol_top_hd">Privacy Policy</div>
ProBizList respects the privacy of our users and has developed this Privacy Policy to
demonstrate its commitment to protecting your privacy. This Privacy Policy is intended to
describe for you, as an individual who is a user of ProBizList (and all websites and URL's
controlled or operated by ProBizList which link to this policy, unless otherwise specified) or our
services, or otherwise provide us with information through various means the information we
collect, how that information may be used, with whom it may be shared, and your choices
about such uses and disclosures.
<p>We encourage you to read this Privacy Policy carefully when using our website or services or
transacting business with us. By using our website, you are accepting the practices described in
this Privacy Policy.If you have any questions about our privacy practices, please refer to the end of this Privacy
Policy for information on how to contact us.</p>

<div class="pol_hd">Information we collect about you</div>
In General. We may collect personal information that can identify you such as your name and
email address and other information that does not identify you. When you provide personal
information through our website, the information may be sent to servers located in the United
States and other countries around the world.

<ul><li><p>Information you provide. We may collect and store any personal information you enter on our website
or provide to us in some other manner. This includes identifying information, such as your name,
address, e-mail address, and telephone number, and in addition, for Professionals, your credit card
number and other personally identifiable information. We also may request information about your
interests and activities, your gender and age, and other demographic information</p></li>
<li><p>Information from other sources.We may also periodically obtain both personal and non-personal
information about you from other business partners, contractors and other third parties. Examples of
information that we may receive include (but are not limited to): updated delivery and address
information, purchase history, and additional demographic information.</p></li>
<li><p>Information about others.We may also collect and store personal information about other people that
you provide to us. If you use our website to send others (friends, relatives, colleagues, etc.) information
that may interest them through our system, we may store your personal information, and the personal
information of each such recipien</p></li>
</ul>

<div class="pol_hd">Use of cookies and other technologies to collect information</div>
<p>We use various technologies to
collect information from your computer and about your activities on our site</p>

<ul><li><p>Information collected automatically.We automatically collect information from your browser when you
visit our website. This information includes your IP address, your browser type and language, access
times, the content of any undeleted cookies that your browser previously accepted from us (see
"Cookies" below), and the referring website address.</p></li>
<li><p>Cookies.When you visit our website, we may assign your computer one or more cookies to facilitate
access to our site and to personalize your online experience. Through the use of a cookie, we also may
automatically collect information about your online activity on our site, such as the web pages you visit,
the links you click, and the searches you conduct on our site. Most browsers automatically accept
cookies, but you can usually modify your browser setting to decline cookies. If you choose to decline
cookies, please note that you may not be able to sign in or use some of the interactive features offered
on our website.</p></li>
<li><p>Other Technologies.We may use standard Internet technology, such as web beacons and other similar
technologies, to track your use of our site. We also may include web beacons in promotional [or other]
e-mail messages or newsletters to determine whether messages have been opened and acted upon.
The information we obtain in this manner enables us to customize the services we offer our website
visitors to deliver targeted advertisements and to measure the overall effectiveness of our online
advertising, content, programming or other activities.</p></li>
<li><p>Information collected by third-parties.We may allow third-parties, including (but not limited to) our
authorized service providers, advertising companies, and ad networks, to display advertisements on
our site. These companies may use tracking technologies, such as cookies, to collect information about
users who view or interact with their advertisements. Our website does not provide any personal
information to these third parties. This information allows them to deliver targeted advertisementsand gauge their effectiveness. Some of these third-party advertising companies may be advertising networks that are members of the Network Advertising Initiative, which offers a single location to opt
out of ad targeting from member companies</p></li></ul>

<div class="pol_hd">How we use the information we collect</div>
In general. We may use information that we collect about you to:
<ul><li><p>deliver the products and services that you have requested;</p></li>
<li><p>manage your account and provide you with customer support;</p></li>
<li><p>perform research and analysis about your use of, or interest in, our products, services, or content, or
products, services or content offered by others;</p></li>
<li><p>communicate with you by e-mail, postal mail, telephone and/or mobile devices or send newsletters
about products or services that may be of interest to you either from us or other third parties;</p></li>
<li><p>communicate with you with regard to partially completed service requests;</p></li>
<li><p>develop and display content and advertising tailored to your interests on our site and other sites;</p></li>
<li><p>verify your eligibility and deliver prizes in connection with contests and sweepstakes;</p></li>
<li><p>perform background screening, which may include the use of third parties, on Service Professionals</p></li>
<li><p>enforce our terms and conditions;</p></li>
<li><p>manage our business and</p></li>
<li><p>perform functions as otherwise described to you at the time of collection</p></li></ul>

<div class="pol_hd">Financial information</div>For Professionals, we may use financial information or payment method
to process payment for any purchases made on our website, enroll you in the discount, rebate,
and other programs in which you elect to participate, to pre-qualify you for credit card and
other offers that you might find of interest, to pre-qualify Professionals to participate in our
directory service, to protect against or identify possible fraudulent transactions, and otherwise
as needed to manage our business.
<div class="pol_hd">Job applicants</div> If your personal information is submitted through our website when applying
for a position with our company, the information will be used solely in connection with
considering and acting upon your application. We may retain your personal information for a
period of time, but only for the purpose of considering your application for current or future
available positions. This information may be shared with our other companies for the purpose
of evaluating your qualifications for the particular position or other available positions, as well
as with third-party service providers retained by us to collect, maintain and analyze candidate
submissions for job postings

<div class="pol_hd">With whom we share your information</div>
We want you to understand when and with whom we may share personal or other information
we have collected about you or your activities on our web site or while using our services.
Personal information. We do not share your personal information with others except asindicated below or when we inform you and give you an opportunity to opt out of having your personal information shared. 
<div class="pol_hd">We may share personal information with:</div>
<ul><li><p>Authorized service providers: We may share your personal information with our authorized service
providers that perform certain services on our behalf. These services may include fulfilling orders,
processing credit card payments, delivering packages, providing customer service and marketing
assistance, performing business and sales analysis, supporting our website functionality, and
supporting contests, sweepstakes, surveys and other features offered through our website or
performing background checks of Professionals. These service providers may have access to personal
information needed to perform their functions but are not permitted to share or use such information
for any other purposes.</p></li>
<li><p>Business partners :When you make purchases, reservations or engage in promotions offered through
our website or our services, we may share personal information with the businesses with which we
partner to offer you those products, services, promotions, contests and/or sweepstakes. When you
elect to engage in a particular merchant's offer or program, you authorize us to provide your email
address and other information to that merchant.</p></li>
<li><p>Professionals. We match your information and service request against our list of Professionals. When
you submit a match request through our website, you consent to our providing your personal
information and request to the Professionals we match with your request. Sharing this information
with Professionals allows them to contact you using the e-mail address or other contact information
you provided. In addition, we have other approved contractual partners that fulfill service requests, or
that utilize their own Professionals to supplement our network, and we share your information with
them, subject to contractual confidentiality restrictions, in order to attempt to provide the services
requested. If using our services pursuant to a membership with one of our partners, ProBizList may
share your service request activity information with such partner. We may also release information to
collection and/or credit agencies for past due Professional accounts.</p></li>
<li><p>Direct mail partners. From time to time we may share our postal mailing list with selected providers of
goods and services that may be of interest to you. If you prefer not to have us share your postal
mailing information with these selected providers, you can notify us at any time by emailing us at
service@tosinioo.ng</p></li>
<li><p>Other Situations. We also may disclose your information:</p></li>
<li><p>In response to a subpoena or similar investigative demand, a court order, or a request for cooperation
from a law enforcement or other government agency; to establish or exercise our legal rights; to
defend against legal claims; or as otherwise required by law. In such cases, we may raise or waive any
legal objection or right available to us.</p></li>
<li><p>When we believe disclosure is appropriate in connection with efforts to investigate, prevent, or take
other action regarding illegal activity, suspected fraud or other wrongdoing; to protect and defend the
rights, property or safety of our company, our users, our employees, or others; to comply with
applicable law or cooperate with law enforcement; or to enforce our website terms and conditions or
other agreements or policies.</p></li>
<li><p>In connection with a substantial corporate transaction, such as the sale of our business, a divestiture,
merger, consolidation, or asset sale, or in the unlikely event of bankruptcy</p></li></ul>

<p>Any third parties to whom we may disclose personal information may have their own privacy
policies which describe how they use and disclose personal information. Those policies will
govern use, handling and disclosure of your personal information once we have shared it with
those third parties as described in this Privacy Policy. If you want to learn more about their
privacy practices, we encourage you to visit the websites of those third parties. These entities or
their servers may be located either inside or outside the United States</p>

<div class="pol_hd">Aggregated and non-personal information</div>
<p>We may share aggregated and non-personal
information we collect under any of the above circumstances. We may also share it with third
parties to develop and deliver targeted advertising on our websites and on websites of third
parties. We may combine non-personal information we collect with additional non-personal
information collected from other sources. We also may share aggregated information with third
parties, including advisors, advertisers and investors, for the purpose of conducting general
business analysis. For example, we may tell our advertisers the number of visitors to our
website and the most popular features or services accessed. </p>

<p>This information does not contain
any personal information and may be used to develop website content and services that we
hope you and other users will find of interest and to target content and advertising. For
Professionals, we may share your business contact information with third parties, including but
not limited to, business name, address, telephone number, email address and name of owner
or proprietor of the business.</p>

<div class="pol_hd">Third-party websites</div>
There are a number of places on our website where you may click on a link to access other
websites that do not operate under this Privacy Policy. For example, if you click on an
advertisement or a search result on our website, you may be taken to a website that we do not
control. These third-party websites may independently solicit and collect information, including
personal information, from you and, in some instances, provide us with information about your
activities on those websites. We recommend that you consult the privacy statements of all
third-party websites you visit by clicking on the "privacy" link typically located at the bottom of
the webpage you are visiting.
<div class="pol_hd">How you can access your information</div>
If you have an online consumer account with us, you have the ability to review and update your
personal information online by logging into your account. You can also review and update your
personal information by contacting us. More information about how to contact us is provided
below.
<p>You can also choose to have your account disabled by contacting service@tosinioo.ng. After you
deactivate your account, you will not be able to sign in to our website or access any of your
personal information. However, you can open a new account at any time. If you deactivate your
account, we may still retain certain information associated with your account for analytical
purposes and recordkeeping integrity, as well as to prevent fraud, collect any fees owed,
enforce our terms and conditions, take actions we deem necessary to protect the integrity of
our web site or our users, or take other actions otherwise permitted by law. In addition, if
certain information has already been provided to third parties as described in this Privacy
Policy, retention of that information will be subject to those third parties' policies.</p>

<div class="pol_hd">Your choices about collection and use of your information</div>
<ul><li><p>You can choose not to provide us with certain information, but that may result in you being unable to
use certain features of our website because such information may be required in order for you to
register as a member of our directory service; to use our services; purchase products or services;
participate in a contest, promotion, survey, or sweepstakes; ask a question; or initiate other
transactions on our website.</p></li>
<li><p>At any time a consumer user can choose to no longer receive commercial or promotional emails or
newsletters from us by accessing your user account and opting out. You also will be given the
opportunity, in any commercial e-mail that we send to you, to opt out of receiving such messages in
the future. It may take up to 10 days for us to process an opt-out request. We may send you other
types of transactional and relationship e-mail communications, such as service announcements,
administrative notices, and surveys, without offering you the opportunity to opt out of receiving them.</p></li>
<li><p>If you prefer not to have us share your postal mailing information with these selected providers of
goods and services that may be of interest to you, you can notify us at any time by emailing us.</p></li></ul>

<div class="pol_hd">How we protect your personal information</div>
We take appropriate security measures (including physical, electronic and procedural
measures) to help safeguard your personal information from unauthorized access and
disclosure. For example, only authorized employees are permitted to access personal
information, and they may do so only for permitted business functions. We use firewalls to help
prevent unauthorized persons from gaining access to your personal information.
We want you to feel confident using our website to transact business. However, no system can
be completely secure. Therefore, although we take steps to secure your information, we do not
promise, and you should not expect, that your personal information, searches, or other
communications will always remain secure. Please refer to the Federal Trade Commission's
website at http://www.ftc.gov/bcp/menus/consumer/data.shtm for information about how to
protect yourself against identity theft.

<div class="pol_hd">Blogs, bulletin boards, reviews and chat rooms</div>
We may provide areas on our websites where you can post information about yourself and
others and communicate with others, as well as post reviews of products, establishments,
contractors, and the like, or upload content (e.g. pictures, videos, audio files, etc.). Such postings
are governed by our Terms & Conditions. In addition, such postings may appear on other
websites or when searches are executed on the subject of your posting. Also, whenever you
voluntarily disclose personal information on publicly-viewable web pages, that information will
be publicly available and can be collected and used by others. For example, if you post your
email address, you may receive unsolicited messages. We cannot control who reads your
posting or what other users may do with the information you voluntarily post, so we encourage
you to exercise discretion and caution with respect to your personal information. Once you
have posted information, you may not be able to edit or delete such information.
<div class="pol_hd">Children's privacy</div>
Our website is a general audience site, and we do not knowingly collect personal information
from children under the age of 13.
<div class="pol_hd">Visiting our websites from outside the Nigeria</div>
This Privacy Policy is intended to cover collection of information on our website from residents
of the Nigerian. If you are visiting our website from outside the Nigeria, please be aware that
your information may be transferred to, stored, and processed in Nigeria where our servers are
located and our central database is operated. The data protection and other laws of the Nigeria
and other countries might not be as comprehensive as those in your country. Please be
assured that we seek to take reasonable steps to ensure that your privacy is protected. By using
our services, you understand that your information may be transferred to our facilities and
those third parties with whom we share it as described in this privacy policy.
<div class="pol_hd">No Rights of Third Parties</div>
This Privacy Policy does not create rights enforceable by third parties or require disclosure of
any personal information relating to users of the website.
<div class="pol_hd">Changes to this Privacy Policy</div>
We will occasionally update this Privacy Policy to reflect changes in our practices and services.
We recommend that you check our website from time to time to inform yourself of any changes
in this Privacy Policy or any of our other policies.
<div class="pol_hd">How to contact us</div>
If you have any questions about this Privacy Policy or our information-handling practices, or if
you would like to request information about our disclosure of personal information to third
parties for their direct marketing purposes, please contact us by e-mail as follows:
info@probizlist.com
<div class="pol_hd">For our Canadian users:</div>
Your rights to access your personal information are not absolute. We may deny access
<ul><li><p>When denial of access is required by law</p></li>
<li><p>When granting you access would have an unreasonable impact on other people's privacy;</p></li>
<li><p>To protect our Company's rights and property; or</p></li>
<li><p>Where the request if frivolous or vexatious</p></li></ul>
<p>If we deny your request for access to, or refuse a request to correct personal information, we
will explain why.</p>
<div class="pol_hd">ProBizList All rights reserved</div>

<p>We may provide this information in a standardized format that is not specific to you. The
designated email address for these requests is service@tosinioo.ng.</p>
<div class="pol_hd">Linked information:</div>
<div class="pol_hd">Cookies:</div>
<p>A cookie is a small text file that is stored on a user's computer for record keeping purposes.
Cookies can be either session cookies or persistent cookies. A session cookie expires when you
close your browser and is used to make it easier for you to navigate our website. A persistent
cookie remains on your hard drive for an extended period of time.</p>
<p>
For example, when you sign in to our website, we will record your user or member ID and the
name on your user or member account in the cookie file on your computer. We also may
record your password in this cookie file, if you indicated that you would like your password
saved for automatic sign-in. For security purposes, we will encrypt any usernames, passwords,
and other user or member account-related data that we store in such cookies. In the case of
sites and services that do not use a user or member ID, the cookie will contain a unique
identifier. We may allow our authorized service providers to serve cookies from our website to
allow them to assist us in various activities, such as doing analysis and research on the
effectiveness of our site, content and advertising.</p>
<p>
You may delete or decline cookies by changing your browser settings. (Click "Help" in the
toolbar of most browsers for instructions.) If you do so, some of the features and services of
our website may not function properly.</p>
<p>
We may allow third-parties, including advertising companies and ad networks, to display
advertisements on our site. These companies may use tracking technologies, such as cookies,
to collect information about users who view or interact with their advertisements. Our website
does not provide any personal information to these third parties, but they may collect
information about where you, or others who are using your computer, saw and/or clicked on
the advertisements they deliver, and possibly associate this information with your subsequent
visits to the advertised websites. They also may combine this information with personal
information they collect from you. The collection and use of that information is subject to the
third-party's privacy policy. This information allows them to deliver targeted advertisements
and gauge their effectiveness. Some of these third-party advertising companies may be
advertising networks that are members of the Network Advertising Initiative, which offers a
single location to opt out of ad targeting from member companies
(www.networkadvertising.org).</p>

<div class="pol_hd">Web Beacons:</div>
Web beacons (also known as clear gifs, pixel tags or web bugs) are tiny graphics with a unique
identifier, similar in function to cookies, and are used to track the online movements of web
users or to access cookies. Unlike cookies which are stored on the user's computer hard drive,web beacons are embedded invisibly on the web pages (or in email) and are about the size of the period at the end of this sentence.
<p>
Web beacons may be used to deliver or communicate with cookies, to count users who have
visited certain pages and to understand usage patterns. We also may receive an anonymous
identification number if you come to our site from an online advertisement displayed on a
third-party website.</p>
</div></div>
<div class="row" style="margin:40px 0 0;">
<div class="ad-contact-btn btm"><a href="https://probizlist.com/businesses/ProBizList-8.php"><button class="offer-btn">Contact Us</button></a></div>
</div>
</div><!-- Mainbody end DIV -->

<?php require 'inc/footer.php'; ?>
</body>
</html>