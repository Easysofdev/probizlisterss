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
<div class="pol_top_hd">TERMS OF USE</div>
<ol><li><div class="pol_hd">ACCEPTANCE OF TERMS</div></li>
ProBizList provides a collection of online resources, including Business and Professional directory and
classified ads, forums, catalogs, and various email services available on or through ProBizList
(referred to hereafter as "the Service") subject to the following Terms of Use ("TOU"). By using the
Service in any way, you are agreeing to comply with the TOU. In addition, when using particular
ProBizList services, you agree to as bide by any applicable posted guidelines for all ProBizList
services, which may change from time to time. Should you object to any term or condition of the
TOU, any guidelines, or any subsequent modifications thereto or become dissatisfied with the
Service in any way, your only recourse is to immediately discontinue use of the Service.
<li><div class="pol_hd">MODIFICATIONS TO THIS AGREEMENT</div></li>
We reserve the right, at our sole discretion, to change, modify or otherwise alter these terms and
conditions at any time. Such modifications shall become effective immediately upon the posting
thereof. You must review this agreement on a regular basis to keep yourself apprised of any
changes.
<li><div class="pol_hd">ELIGIBILITY FOR USE</div></li>
ProBizList reserves some parts of the Service exclusively for professional purchasers, sellers,
collectors and resellers of items and accessories who are acceptable to ProBizList in its sole
discretion. Although ProBizList attempts to limit the use of these parts of the Service to such
purchasers, sellers, collectors and resellers of items and accessories, nothing herein shall create any
right of action against ProBizList for failing to adequately screen potential users or prevent the use
of ProBizList or the Service by users who are not professional purchasers, sellers, collectors and
resellers of items or accessories.
<li><div class="pol_hd">CONTENT</div></li>
You understand that all advertisements, postings, messages, text, files, images, photos, video,
sounds, or other materials ("Content") posted on, transmitted through, or linked from the Service
are the sole responsibility of the person from whom such Content originated. More specifically, you
are entirely responsible for each individual item of Content that you post, email or otherwise make
available via the Service. Likewise, if you request the assistance of ProBizList to post content, or if
you imply consent that ProBizList may post content on your behalf, either by written or oral means,
or you fail to inform ProBizList that content should be removed, you are equally responsible for the
content. You waive any and all claims against ProBizList of a right of publicity for your image or
likeness throughout the world by posting any information or pictures of yourself on ProBizList. You
understand that ProBizList does not control, and is not responsible for personal Content made
available through the Service, and that by using the Service, you may be exposed to Content that is
offensive, indecent, inaccurate, misleading, or otherwise objectionable. When you post User Content
to the Service, you authorize and direct us to make such copies thereof as we deem necessary in
order to facilitate the posting and storage of the Content on the Service. By posting Content to any
part of the Service, you automatically grant, and you represent and warrant that you have the right
to grant, to the Company an irrevocable, perpetual, non-exclusive, transferable, fully paid,
worldwide license (with the right to sublicense) to use, copy, publicly perform, publicly display,
reformat, translate, excerpt (in whole or in part) and distribute such Content for any purpose on or
in connection with the Service or the promotion thereof, to prepare derivative works of, or
incorporate into other works, such Content, and to grant and authorize sublicenses of the foregoing.
Furthermore, ProBizList and Content available through the Service may contain links to other
websites, which are completely independent of ProBizList. ProBizList makes no representation or
warranty as to the accuracy, completeness or authenticity of the information contained in any such
site. Following links to any other websites is at your own risk. You agree that you must evaluate,
and bear all risks associated with, the use of any Content, that you may not rely on said Content,
and that under no circumstances will ProBizList be liable in any way for any Content or for any loss
or damage of any kind incurred as a result of the use of any Content posted, emailed or otherwise
made available via the Service. You acknowledge that ProBizList does not pre-screen or approve
Content, but that ProBizList shall have the right (but not the obligation) in its sole discretion to
refuse, delete or move any Content that is available via the Service, for violating the letter or spirit
of the TOU or for any other reason.
<li><div class="pol_hd">THIRD PARTY CONTENT, SITES, AND SERVICES</div></li>
ProBizList and Content available through the Service may contain features and functionalities that
may link you or provide you with access to third party content which is completely independent of
ProBizList, including web sites, directories, servers, networks, systems, information and databases,
applications, software, programs, products or services, and the Internet as a whole. Your
interactions with organizations and/or individuals found on or through the Service, including
payment and delivery of goods or services, and any other terms, conditions, warranties or
representations associated with such dealings, are solely between you and such organizations
and/or individuals. You should make whatever investigation you feel necessary or appropriate before
proceeding with any online or offline transaction with any of these third parties. We do not
guarantee the quality, safety or legality of, any Content, the truth or accuracy of the descriptions of
any goods or services offered for sale, the right of the sellers to sell or license any such goods or
services, or the ability of any buyer to purchase any such goods or services. The Service is designed
for experienced buyers accustomed to buying goods and services based on photographs and/or
descriptive text. Buyers should assume that any goods offered are not new, unless otherwise stated,
nor in perfect condition, and may require touch-up or repairs prior to use and that the available
information about the items may be limited. It is not possible for ProBizList to verify information
provided by the seller of any item.
You agree that ProBizList shall not be responsible or liable for any loss or damage of any sort
incurred as the result of any dealings between users of the Service. If there is a dispute between
users of the Service, or between users and any third party, you understand and agree that
ProBizList is under no obligation to become involved. In the event that you have a dispute with one
or more other users, you hereby forever release ProBizList, its officers, employees, agents and
successors in rights from claims, demands and damages (actual and consequential) of every kind or
nature, known or unknown, suspected and unsuspected, disclosed and undisclosed, arising out of or
in any way related to such disputes and/or our service.
<li><div class="pol_hd">NOTIFICATION OF CLAIMS OF INFRINGEMENT</div></li>
If you believe that your work has been copied in a way that constitutes copyright infringement, or
your intellectual property rights have been otherwise violated, please send your notice ("Notice") to
ProBizList's agent for notice of claims of copyright or other intellectual property infringement:
by email:
info@probizlist.com
Please include the following with your Notice to our Abuse Agent:
The identity of the material on ProBizList that you claim is infringing, in sufficient detail so that we
may locate it on the website;
A statement by you that you have a good faith belief that the disputed use is not authorized by the
copyright owner, its agent, or the law;
Your address, telephone number, and email address;
A statement by you declaring under penalty of perjury that (i) the above information in your Notice
is accurate, and (ii) that you are the owner of the copyright interest involved or that you are
authorized to act on behalf of that owner; and
Your physical or electronic signature.
<li><div class="pol_hd">PRIVACY AND INFORMATION DISCLOSURE</div></li>
ProBizList may, in its sole discretion, preserve or disclose your Content, as well as your information,
such as email addresses, IP addresses, timestamps, and other user information. Your personal
information is further governed by ProBizList's Privacy Policy.
<li><div class="pol_hd">CONDUCT</div></li>
You agree not to post, email, or otherwise make available Content:
<ul><li>that is unlawful, harmful, threatening, abusive, harassing, defamatory, libelous, invasive of another's
privacy, or is harmful to minors in any way;</li>
<li>that is pornographic or depicts a human being engaged in sexual activities or exposing sexual organs
unfitting for the Service; </li>
<li>that harasses, degrades, intimidates or is hateful toward an individual or group of individuals on the basis of
religion, gender, sexual orientation, race, ethnicity, age, or disability; </li>
<li>that suggests a discriminatory preference based on race, color, national origin, religion, sex, familial status
or handicap (or violates any state or local law prohibiting discrimination on the basis of these or other
characteristics); </li>
<li>that violates federal, state, or local equal employment opportunity laws, including but not limited to, stating
in any advertisement for employment a preference or requirement based on race, color, religion, sex,
national origin, age, or disability; </li>
<li>with respect to employers that employ four or more employees, that violates the anti-discrimination
provision of the Immigration and Nationality Act, including requiring U.S. citizenship or lawful permanent
residency (green card status) as a condition for employment, unless otherwise required in order to comply
with law, regulation, executive order, or federal, state, or local government contract; </li>
<li>that impersonates any person or entity, including, but not limited to, a ProBizList employee, or falsely states
or otherwise misrepresents your affiliation with a person or entity (this provision does not apply to Content
that constitutes lawful non-deceptive parody of public figures.);
<li>that includes personal or identifying information about another person without that person's explicit
consent; </li>
<li>that is fraudulent, false, deceptive, misleading, deceitful, misinformative, or constitutes "bait and switch"; </li>
<li>that infringes any patent, trademark, trade secret, copyright or other proprietary rights of any party, or
Content that you do not have a right to make available under any law or under contractual or fiduciary
relationships; </li>
<li>that constitutes or contains "affiliate marketing," "link referral code," "junk mail," "spam," "chain letters,"
"pyramid schemes," or unsolicited commercial advertisement; </li>
<li>that constitutes or contains any form of advertising or solicitation if: posted in areas of ProBizList which are
not designated for such purposes; </li>
<li>or emailed to ProBizList users who have not indicated in writing that it is ok to contact them about other
services, products or commercial interests. that includes links to commercial services or web sites, except as
specifically permitted; </li>
<li>that advertises any illegal service or the sale of any items the sale of which is prohibited or restricted by any
applicable law; </li>
<li>that contains software viruses or any other computer code, files or programs designed to interrupt, destroy
or limit the functionality of any computer software or hardware or telecommunications equipment; </li>
<li>that disrupts the normal flow of dialogue with an excessive amount of Content (flooding attack) to the
Service, or that otherwise negatively affects other users' ability to use the Service; </li>
<li>or that employs misleading email addresses, or forged headers or otherwise manipulated identifiers in order
to disguise the origin of Content transmitted through the Service. </li></ul>
Additionally, you agree not to:
<ul><li>contact anyone who has asked not to be contacted; </li>
<li> "stalk" or otherwise harass anyone; </li>
<li>collect personal data about other users for commercial or unlawful purposes; </li>
<li>use automated means, including spiders, robots, crawlers, data mining tools, or the like to download data
from the Service � unless expressly permitted by ProBizList; </li>
<li>post irrelevant Content, repeatedly post the same or similar Content or otherwise impose an unreasonable
or disproportionately large load on our infrastructure; </li>
<li>post the same item or service in more than one classified category or forum; </li>
<li>attempt to gain unauthorized access to ProBizList's computer systems or engage in any activity that
disrupts, diminishes the quality of, interferes with the performance of, or impairs the functionality of, the
Service or ProBizList; </li>
<li>or use any form of automated device or computer program that enables the submission of Content on
ProBizList without such Content being manually entered by the author thereof (an "automated posting
device"), including without limitation, the use of any such automated posting device to submit Content in
bulk, or for automatic submission of Content at regular intervals. </li></ul>
<li><div class="pol_hd">POSTING AGENTS</div></li>
A "Posting Agent" is a third-party agent, service, or intermediary that offers to post Content to the
Service on behalf of others. To moderate demands on ProBizList's resources, you may not use a
Posting Agent to post Content to the Service without express permission or license from ProBizList.
Correspondingly, Posting Agents are not permitted to post Content on behalf of others, to cause
Content to be so posted, or otherwise access the Service to facilitate posting Content on behalf of
others, except with express permission or license from ProBizList.
<li><div class="pol_hd">NO SPAM POLICY</div></li>
You understand and agree that sending unsolicited email advertisements to ProBizList email
addresses or through ProBizList computer systems is expressly prohibited by these TOU. Any
unauthorized use of ProBizList computer systems is a violation of the TOU and certain federal and
state laws, including without limitation the Computer Fraud and Abuse Act (18 U.S.C. � 1030 et
seq.). Such violations may subject the sender and his or her agents to civil and criminal penalties.
<li><div class="pol_hd">PAID POSTINGS</div></li>
We may charge a fee to post Content in some areas of the Service. The fee is an access fee
permitting Content to be posted in a designated area. Each party posting Content to the Service is
responsible for said Content and compliance with the TOU. All fees paid will be non-refundable in
the event that Content is removed from the Service for violating the TOU. Fees collected for specific
services, such as subscription services and advertising, are non-refundable unless otherwise stated
in writing for a specific promotional program.
<li><div class="pol_hd">LIMITATIONS ON SERVICE</div></li>
You acknowledge that ProBizList may establish limits concerning use of the Service, including the
maximum number of days that Content will be retained by the Service, the maximum number and
size of postings, email messages, or other Content that may be transmitted or stored by the Service,
and the frequency with which you may access the Service. You agree that ProBizList has no
responsibility or liability for the deletion or failure to store any Content maintained or transmitted by
the Service. You acknowledge that ProBizList reserves the right at any time to modify or discontinue
the Service (or any part thereof) with or without notice, and that ProBizList shall not be liable to you
or to any third party for any modification, suspension or discontinuance of the Service.
<li><div class="pol_hd">ACCESS TO THE SERVICE</div></li>
ProBizList grants you a limited, revocable, nonexclusive license to access the Service for your own
personal use. This license does not include: (a) access to the Service by Posting Agents; or (b) any
collection, aggregation, copying, duplication, display or derivative use of the Service nor any use of
data mining, robots, spiders, or similar data gathering and extraction tools for any purpose unless
expressly permitted by ProBizList. A limited exception to (b) is provided to general purpose internet
search engines and non-commercial public archives that use such tools to gather information for the
sole purpose of displaying hyperlinks to the Service, provided they each do so from a stable IP
address or range of IP addresses using an easily identifiable agent and comply with our robots.txt
file. "General purpose internet search engine" does not include a website or search engine or other
service that specializes in classified listings or in any subset of classifieds listings such as decorative
goods or furniture, or which is in the business of providing classified ad listing services.
ProBizList does not permit you to display on your website, or create a hyperlink on your website to,
individual postings on the Service, absent express permission granted by ProBizList to do so. You
may create a hyperlink to the home page of ProBizList, so long as the link does not portray
ProBizList, its employees, or its affiliates in a false, misleading, derogatory, or otherwise offensive
matter.
ProBizList may offer various parts of the Service in RSS format so that users can embed individual
feeds into a personal website or blog, or view postings through third party software news
aggregators. ProBizList permits you to display, excerpt from, and link to the RSS feeds on your
personal website or personal web blog, provided that (a) your use of the RSS feed is for personal,
non-commercial purposes only, (b) each title is correctly linked back to the original post on the
Service and redirects the user to the post when the user clicks on it, (c) you provide, adjacent to the
RSS feed, proper attribution to "ProBizList" as the source, (d) your use or display does not suggest
that ProBizList promotes or endorses any third party causes, ideas, web sites, products or services,
(e) you do not redistribute the RSS feed, and (f) your use does not overburden ProBizList's systems.
ProBizList reserves all rights in the content of the RSS feeds and may terminate any RSS feed at any
time.
Use of the Service beyond the scope of authorized access granted to you by ProBizList immediately
terminates said permission or license. In order to collect, aggregate, copy, duplicate, display or
make derivative use of the Service or any Content made available via the Service for other purposes
(including commercial purposes) not stated herein, you must first obtain a written license from
ProBizList that has been signed by one of ProBizList's authorized representatives.
<li><div class="pol_hd">TERMINATION OF SERVICE</div></li>
You agree that ProBizList, in its sole discretion, has the right (but not the obligation) to delete or
deactivate your account, block your email or IP address, or otherwise terminate your access to or
use of the Service (or any part thereof), immediately and without notice, and remove and discard
any Content within the Service, for any reason, including, without limitation, if ProBizList believes
that you have acted inconsistently with the letter or spirit of the TOU. Further, you agree that
ProBizList shall not be liable to you or any third-party for any termination of your access to the
Service. Further, you agree not to attempt to use the Service after said termination. Sections 2-7
and 13-20 shall survive termination of the TOU.
<li><div class="pol_hd">PROPRIETARY RIGHTS</div></li>
The Service is protected to the maximum extent permitted by copyright laws and international
treaties. Content displayed on or through the Service is protected by copyright as a collective work
and/or compilation, pursuant to copyrights laws, and international conventions. Any reproduction,
modification, creation of derivative works from or redistribution of the site or the collective work,
and/or copying or reproducing the sites or any portion thereof to any other server or location for
further reproduction or redistribution is prohibited without the express written consent of ProBizList.
You further agree not to reproduce, duplicate or copy Content from the Service without the express
written consent of ProBizList, and agree to abide by any and all copyright notices displayed on the
Service. You may not decompile or disassemble, reverse engineer or otherwise attempt to discover
any source code contained in the Service. Without limiting the foregoing, you agree not to
reproduce, duplicate, copy, sell, resell or exploit for any commercial purposes, any aspect of the
Service. ProBizList, as well as certain other of the names, logos, and materials displayed on
ProBizList, constitute trademarks, trade names, service marks or logos ("Marks") of ProBizList or
other entities. You are not authorized to use any such Marks. Ownership of all such Marks and the
goodwill associate therewith remains with ProBizList or those other entities.
Although ProBizList does not claim ownership of content that its users post, by posting Content to
any public area of the Service, you automatically grant, and you represent and warrant that you
have the right to grant, to ProBizList an irrevocable, perpetual, non-exclusive, fully paid, worldwide
license to use, copy, perform, display, and distribute said Content and to prepare derivative works
of, or incorporate into other works, said Content, and to grant and authorize sublicenses (through
multiple tiers) of the foregoing. Furthermore, by posting Content to any public area of the Service,
you automatically grant ProBizList all rights necessary to prohibit any subsequent aggregation,
display, copying, duplication, reproduction, or exploitation of the Content on the Service by any
party for any purpose.
<li><div class="pol_hd">DISCLAIMER OF WARRANTIES</div></li>
YOU AGREE THAT USE OF ProBizList AND THE SERVICE IS ENTIRELY AT YOUR OWN RISK.
ProBizList AND THE SERVICE ARE PROVIDED ON AN "AS IS" OR "AS AVAILABLE" BASIS, WITHOUT
ANY WARRANTIES OF ANY KIND. ALL EXPRESS AND IMPLIED WARRANTIES, INCLUDING,
WITHOUT LIMITATION, THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR
PURPOSE, AND NON-INFRINGEMENT OF PROPRIETARY RIGHTS ARE EXPRESSLY DISCLAIMED TO
THE FULLEST EXTENT PERMITTED BY LAW. TO THE FULLEST EXTENT PERMITTED BY LAW,
ProBizList DISCLAIMS ANY WARRANTIES FOR THE SECURITY, RELIABILITY, TIMELINESS,
ACCURACY, AND PERFORMANCE OF ProBizList AND THE SERVICE. TO THE FULLEST EXTENT
PERMITTED BY LAW, ProBizList DISCLAIMS ANY WARRANTIES FOR OTHER SERVICES OR GOODS
RECEIVED THROUGH OR ADVERTISED ON ProBizList OR THE SERVICE, OR ACCESSED THROUGH
ANY LINKS ON ProBizList OR THE SERVICE, INCLUDING WITHOUT LIMITATION, WARRANTY OF
TITLE TO OR DELIVERY OF ANY GOOD OR SERVICE, ANY WARRANTY WITH RESPECT TO
INTELLECTUAL PROPERTY RIGHTS IN ANY GOOD OR SERVICE, ANY WARRANTY THAT ANY GOOD
OR SERVICE CONFORMS TO ITS DESCRIPTION OR THE COLORS, TEXTURE AND DETAIL SHOWN
ON THE USER'S COMPUTER MONITOR. TO THE FULLEST EXTENT PERMITTED BY LAW, ProBizList
DISCLAIMS ANY WARRANTIES FOR VIRUSES OR OTHER HARMFUL COMPONENTS IN CONNECTION
WITH ProBizList OR THE SERVICE. NO ADVICE OR INFORMATION, WHETHER ORAL OR WRITTEN,
OBTAINED BY YOU FROM ProBizList, ProBizList OR THROUGH THE SERVICE SHALL CREATE ANY
WARRANTY NOT EXPRESSLY MADE HEREIN. Some jurisdictions do not allow the disclaimer of
implied warranties. In such jurisdictions, some of the foregoing disclaimers may not apply to you
insofar as they relate to implied warranties.
<li><div class="pol_hd">LIMITATIONS OF LIABILITY</div></li>
UNDER NO CIRCUMSTANCES SHALL ProBizList BE LIABLE FOR DIRECT, INDIRECT, INCIDENTAL,
SPECIAL, CONSEQUENTIAL OR EXEMPLARY DAMAGES (EVEN IF ProBizList HAS BEEN ADVISED OF
THE POSSIBILITY OF SUCH DAMAGES), RESULTING FROM ANY ASPECT OF YOUR USE OF
ProBizList OR THE SERVICE, WHETHER THE DAMAGES ARISE FROM USE OR MISUSE OF ProBizList
OR THE SERVICE, FROM INABILITY TO USE ProBizList OR THE SERVICE, OR THE INTERRUPTION,
SUSPENSION, MODIFICATION, ALTERATION, OR TERMINATION OF ProBizList OR THE SERVICE.
SUCH LIMITATION SHALL ALSO APPLY WITH RESPECT TO DAMAGES INCURRED BY REASON OF
OTHER SERVICES OR PRODUCTS RECEIVED THROUGH OR ADVERTISED IN CONNECTION WITH
ProBizList OR THE SERVICE OR ANY LINKS ON ProBizList OR THE SERVICE, AS WELL AS BY
REASON OF ANY INFORMATION OR ADVICE RECEIVED THROUGH OR ADVERTISED IN
CONNECTION WITH ProBizList OR THE SERVICE OR ANY LINKS ON ProBizList. THESE LIMITATIONS
SHALL APPLY TO THE FULLEST EXTENT PERMITTED BY LAW. In some jurisdictions, limitations of
liability are not permitted. In such jurisdictions, some of the foregoing limitation may not apply to
you.
<li><div class="pol_hd">INDEMNITY</div></li>
You agree to indemnify and hold ProBizList, its officers, subsidiaries, affiliates, successors, assigns,
directors, officers, agents, service providers, suppliers and employees, harmless from any claim or
demand, including reasonable attorney fees and court costs, made by any third party due to or
arising out of Content you submit, post or make available through the Service, your use of the
Service, your violation of the TOU, your breach of any of the representations and warranties herein,
or your violation of any rights of another.
<li><div class="pol_hd">GENERAL INFORMATION</div></li>
The TOU, and any additional terms to which you agree when using particular elements of the
Service, constitutes the entire agreement between you and ProBizList and governs your use of the
Service, superseding any prior agreement between you and ProBizList. The failure of ProBizList to
exercise or enforce any right or provision of the TOU shall not constitute a waiver of such right or
provision. If any provision of the TOU is found by a court of competent jurisdiction to be invalid, the
parties nevertheless agree that the court should endeavor to give effect to the parties' intentions as
reflected in the provision, and the other provisions of the TOU remain in full force and effect. You
agree that regardless of any statute or law to the contrary, any claim or cause of action
arising out of or related to use of the Service or the TOU must be filed within one (1)
year after such claim or cause of action arose or be forever barred.
<li><div class="pol_hd">VIOLATION OF TERMS AND LIQUIDATED
DAMAGES</div></li>
Please report any violations of the TOU by sending an email to notice@tosinioo.ng.
Our failure to act with respect to a breach by you or others does not waive our right to act with
respect to subsequent or similar breaches.
You understand and agree that, because damages are often difficult to quantify, if it becomes
necessary for ProBizList to pursue legal action to enforce the TOU, you will be liable to pay
ProBizList the following amounts as liquidated damages, which you accept as reasonable estimates
of ProBizList's damages for the specified breaches of the TOU:
If you post a message that (i) impersonates any person or entity; (ii) falsely states or otherwise
misrepresents your affiliation with a person or entity; or (iii) that includes personal or identifying
information about another person without that person's explicit consent, you agree to pay ProBizList
one thousand dollars ($1,000) for each such message. This provision does not apply to messages
that are lawful non-deceptive parodies of public figures.
If ProBizList establishes limits on the frequency with which you may access the Service, or
terminates your access to or use of the Service, you agree to pay ProBizList one hundred dollars
($100) for each message posted in excess of such limits or for each day on which you access
ProBizList in excess of such limits, whichever is higher.
If you send unsolicited email advertisements to ProBizList email addresses or through ProBizList
computer systems, you agree to pay ProBizList twenty five dollars ($25) for each such email.
If you post Content in violation of the TOU, other than as described above, you agree to pay
ProBizList one hundred dollars ($100) for each item of Content posted. In its sole discretion,
ProBizList may elect to issue a warning before assessing damages.
If you are a Posting Agent that uses the Service in violation of the TOU, in addition to any liquidated
damages under clause (d), you agree to pay ProBizList one hundred dollars ($100) for each and
every item of Content posted in violation of the TOU. A Posting Agent will also be deemed an agent
of the party engaging the Posting Agent to access the Service (the "Principal"), and the Principal (by
engaging the Posting Agent in violation of the TOU) agrees to pay ProBizList an additional one
hundred dollars ($100) for each item of Content posted by the Posting Agent on behalf of the
principal in violation of the TOU.
If you aggregate, display, copy, duplicate, reproduce, or otherwise exploit for any purpose any
Content (except for your own Content) in violation of the TOU without ProBizList's express written
permission, you agree to pay ProBizList three thousand dollars ($3,000) for each day on which you
engage in such conduct.
Notwithstanding any other provision of the TOU, ProBizList retains the right to seek the remedy of
specific performance of any term contained in the TOU, or a preliminary or permanent injunction
against the breach of any such term or in aid of the exercise of any power granted in the TOU, or to
seek to recover damages arising from or relating to a violation of this TOU or any combination
thereof.
<li><div class="pol_hd">FEEDBACK</div></li>
We welcome your questions and comments. Please send them to service@tosinioo.ng.
<li><div class="pol_hd">TERMS OF USE FOR ALL SERVICES</div></li>
ProBizList offers a variety of online programs (the "Programs") as a convenience to its participating
professionals and persons interested in engaging a professional (the "Consumer") to perform or
receive services ("Services") or information about such Services.
As a condition to your use of the Programs and as material inducement on the part of ProBizList and
its Affiliates to offer the Programs, you expressly acknowledge and agree that:
Use of the Programs are at your sole risk. ProBizList and its Affiliates expressly disclaim any and all
warranties of any kind, express or implied arising out of or relating to:
<p>For Consumers:</p>
<ol type="a"><li>the Programs</li>
<li>the Professional</li>
<li>the Services to be performed by any Professional.</li>
<li>your use of the Programs</li>
<li>the engagement by you of any Professional</li>
<li>any acts, negligence, breach of contract or other conduct engaged in by you or by any of the Professional's agents,
vendors, consultants and the like</li>
<li>any other matter relating to the Programs</li></ol>
.
<p>In no event will ProBizList's liability to you for any reason whatsoever exceed in the
aggregate the sum of $25.00.</p>
<p>ProBizList and its Affiliates do not provide, nor will they provide, any service to or
for you, nor is ProBizList and its Affiliates a party to any agreement which you may
enter into with a Professional. If you engage the services of any Professional, all
arrangements in such regard are solely between you and the concerned Professional.</p>
<p>If any of the above Terms of Use are found by a court of competent jurisdiction to
be invalid, all of the other provisions of the Terms of Use shall remain in full force
and effect.</p>
</p>For Professionals:</p>
<ol type="a"><li>the Programs</li>
<li>the Consumers</li>
<li>the agreement between you and the Consumer.</li></ol>
<p>ProBizList, its Officers, Directors, Members and Employees, as well as ProBizList
Affiliates, shall not be liable to you for any direct, indirect, incidental, special,
consequential or exemplary damages or other losses resulting from or relating in any
manner to:</p>
<ol type="a"><li>your use of the Programs
<li>the engagement of you by any Consumer
<li>any acts, negligence, breach of contract or other conduct engaged in by you or by
any of the your or the Consumer's agents, vendors, consultants and the like
<li>any other matter relating to the Programs.</li></ol>
<p>In no event will ProBizList's liability to you for any reason whatsoever exceed in the
aggregate the sum of $25.</p>
<p>ProBizList and its Affiliates are not a party to any agreement which you may enter
into with a Consumer. If you are engaged by a Consumer, all arrangements in such
regard are solely between you and the concerned Consumer.</p>
<p>If any of the above Terms of Use are found by a court of competent jurisdiction to
be invalid, all of the other provisions of the Terms of Use shall remain in full force
and effect.</p>
Questions about our services programs may be directed to: service@tosinioo.ng
ProBizList, its Officers, Directors, Members and Employees, as well as ProBizList Affiliates, shall not
be liable to you for any direct, indirect, incidental, special, consequential or exemplary damages or
other losses resulting from or relating in any manner to:
<li><div class="pol_hd">BRAND AGREEMENT</div></li></ol>
Legal Disclaimer: By logging in to your ProBizList account, you are agreeing to the terms below and
you are stating that you have the authority to represent the manufacturer's products, pricing, and
copyrighted material online. If you do not agree to the terms, or if you do not have the legal right to
represent this brand relative to the terms below, please do not login to the account.
<ol><li>Parties: This "Agreement" between "I" or "me" or the "Company" and ProBizList.
("ProBizList", together with me, "we" or the "parties") governs the relationship between the
parties. The parties agree to conduct this transaction and permit the creation of this Agreement by
electronic means.</li>
<li>Content: I hereby license to ProBizList the use of the images (including logo, products,
installation photos, etc.), product catalog, and related data, such as and including product pricing,
that I provide or have placed on my website (such images, product catalog, related data, the
"Content") for display on ProBizList and "Affiliated Sites," including related websites, social media
websites, picture hosting websites, and all other website ProBizList at its sole discretion believes will
provide beneficial exposure to me, and for use in emails, quote requests and promotional materials.
I may make suggestions for the best way to showcase my products or display the Content at any
time, but ProBizList retains full discretion regarding what Content (if any) to display, how, and
where. I represent and warrant that I have obtained all rights in the Content necessary for
ProBizList to exercise the rights granted hereunder, that the Content is accurate and representative
of my products, and that I will update my ProBizList account with any updates to the Content
necessary to keep such Content accurate and representative of my products. ProBizList and
Affiliated Sites are not responsible for any damages associated with the Content or its interpretation.</li>
<li>Fees:
(a) Membership: Price as stated on ProBizList at the time of purchase of the membership. Price
remains locked in as long as membership is kept current. All payments are paid upfront at the
beginning of the 30 day billing cycle. All yearly payments are paid upfront at the beginning of the
365 day billing cycle. Payments are automatically deducted from the account on file each billing
cycle, unless I cancel my account.</li>
<li>Length of Contract: This Agreement is valid up to and until I cancel my account.</li>
<li>Billing: In the event that a payment is due on my Membership, but my credit card on file in no
longer valid or active, ProBizList may attempt to contact me to determine updated account
information. ProBizList will wait thirty (30) days before canceling my membership.</li>
<li>Termination: I may request termination of this agreement at any time. Termination will take
effect upon the end of the last day of my billing cycle. ProBizList may terminate this agreement at
will. In the event ProBizList terminates this agreement early, and I am not in violation of any term
of this Agreement, I will receive a prorated reimbursement for the portion of the billing cycle
remaining.</li></ol>

</div></div>
<div class="row" style="margin:40px 0 0;">
<div class="ad-contact-btn btm"><a href="https://probizlist.com/businesses/ProBizList-8.php"><button class="offer-btn">Contact Us</button></a></div>
</div>
</div><!-- Mainbody end DIV -->

<?php require 'inc/footer.php'; ?>
</body>
</html>