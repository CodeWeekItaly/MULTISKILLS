<?php require 'php/db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site policies - IOcommerce</title>
    <link rel="shortcut icon" href="img/favicon/favicon.ico" type="image/x-icon"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/policies.css">
</head>
<body>
    <?php include 'partials/navbar.php';?>
    <?php include 'partials/accessibility.php';?>

    <main>
        <!-- Retrieving user information -->
        <?php
            $sql = "SELECT * FROM users WHERE id = '" . $_SESSION['id'] . "'";
            $result = $mysqli -> query($sql);
            $row = $result -> fetch_assoc();
        ?>

        <div class="container">
            <h2>Site policies</h2>
            <hr>
            <div class="boxed-paragraph">
                This Website collects some Personal Data from its Users.
            

                <h5>Owner of the data treatment</h5>
                            
                IOcommerce
                <br>
                Owner contact email: info@iocommerce.com
                
                            
                <h5>Types of data collected</h5>
                            
                Among the Personal Data collected by this Website, either independently or through third parties, there are: Cookies; Usage data; e-mail; first name; Data communicated while using the service.<br><br>
                
                Complete details on each type of data collected are provided in the dedicated sections of this privacy policy or through specific information texts displayed before the data is collected.<br> 
                Personal Data may be freely provided by the User or, in the case of Usage Data, collected automatically when using this Website.<br>
                Unless otherwise specified, all data requested by this website are mandatory. If the User refuses to communicate with them, it may be impossible for this Website to provide the Service. In cases where this Website indicates some Data as optional, Users are free to refrain from communicating such Data, without this having any consequence on the availability of the Service or on its operation.<br>
                Users who have doubts about which data are mandatory are encouraged to contact the owner.<br>
                Any use of Cookies - or other tracking tools - by this Website or by the owners of third party services used by this Website, unless otherwise specified, is intended to provide the Service requested by the User, as well as for the additional purposes described in this document and in the Cookie Policy, if available.<br><br>
                
                The User assumes responsibility for the Personal Data of third parties obtained, published or shared through this Website and guarantees to have the right to communicate or disseminate them, freeing the Owner from any liability to third parties.
                
                        
                        
                            
                <h4>Method and place of processing of the collected data</h4>
                            
                <h5>Processing methods</h5>
                            
                The Owner takes appropriate security measures to prevent unauthorized access, disclosure, modification or destruction of Personal Data.<br>
                The processing is carried out using IT and / or telematic tools, with organizational methods and with logic strictly related to the purposes indicated. In addition to the Data Controller, in some cases, other subjects involved in the organization of this Website (administrative, commercial, marketing, legal, system administrators) or external subjects (such as third party technical service providers, postal couriers) may have access to the Data. , hosting providers, IT companies, communication agencies) also appointed, if necessary, as Data Processors by the Data Controller. The updated list of Managers can always be requested from the Data Controller.
                
                            
                <h5>Legal basis of the processing</h5>
                            
                The Owner processes Personal Data relating to the User if one of the following conditions exists:
                        
                <ul>
                    <li>the User has given consent for one or more specific purposes; Note: in some jurisdictions the Data Controller may be authorized to process Personal Data without the User's consent or another of the legal bases specified below, as long as the User does not object ("opt-out") to such treatment. However, this is not applicable if the processing of Personal Data is governed by European legislation on the protection of Personal Data;</li>
                    <li>the processing is necessary for the execution of a contract with the User and / or for the execution of pre-contractual measures;</li>
                    <li>the processing is necessary to fulfill a legal obligation to which the Data Controller is subject;</li>
                    <li>the processing is necessary for the execution of a task of public interest or for the exercise of public authority vested in the Data Controller;</li>
                    <li>the processing is necessary for the pursuit of the legitimate interest of the Data Controller or third parties.</li>
                </ul>
                                        
                However, it is always possible to ask the Data Controller to clarify the concrete legal basis of each treatment and in particular to specify whether the treatment is based on the law, provided for by a contract or necessary to conclude a contract.
                            
                <h5>Place</h5>
                            
                The Data is processed at the Data Controller's operating offices and in any other place where the parties involved in the processing are located. For more information, please contact the Data Controller.
                The User's Personal Data may be transferred to a country other than that in which the User is located. To obtain further information on the place of processing, the User can refer to the section relating to the details on the processing of Personal Data.
                The User has the right to obtain information regarding the legal basis for the transfer of Data outside the European Union or to an international organization governed by public international law or consisting of two or more countries, such as the UN, as well as regarding the security measures adopted by the Data Controller to protect the Data.
                The User can check if one of the transfers described above takes place by examining the section of this document relating to the details on the processing of Personal Data or request information from the Data Controller by contacting him at the opening details.
                
                            
                <h5>Retention period</h5>
                            
                The Data are processed and stored for the time required by the purposes for which they were collected.
                
                Therefore:
                <ul>
                    <li>Personal Data collected for purposes related to the execution of a contract between the Owner and the User will be retained until the execution of this contract is completed.</li>
                    <li>Personal Data collected for purposes related to the legitimate interest of the Data Controller will be retained until this interest is satisfied. The User can obtain further information regarding the legitimate interest pursued by the Owner in the relevant sections of this document or by contacting the Owner.</li>
                </ul>                        
                When the processing is based on the User's consent, the Data Controller may keep the Personal Data longer until such consent is revoked. Furthermore, the Data Controller may be obliged to keep Personal Data for a longer period in compliance with a legal obligation or by order of an authority.
                At the end of the retention period, the Personal Data will be deleted. Therefore, at the end of this term the right of access, cancellation, rectification and the right to data portability can no longer be exercised.
                
                        
                        
                            
                <h5>Purpose of processing the collected data</h5>
                            
                The User Data is collected to allow the Owner to provide its Services, as well as for the following purposes: Commercial affiliation, Commenting on contents, Contacting the User, Managing payments, Managing support and contact requests, Managing contacts and sending messages, Interaction with social networks and external platforms, Optimization and distribution of traffic, Advertising, Remarketing and behavioral targeting, Hosting and backend infrastructure, Statistics, Display of content from external platforms and Interaction with live chat platforms.
                To obtain further detailed information on the purposes of the processing and on the Personal Data concretely relevant to each purpose, the User can refer to the relevant sections of this document.
                
                        
                        
                            
                <h5>Details on the processing of Personal Data</h5>
                            
                Personal Data is collected for the following purposes and using the following services:
                <ul>
                    <li>Commercial affiliation: this type of service allows this Website to display advertisements for products or services offered by third parties. Ads can be displayed both in the form of advertising links and in the form of banners in various graphic forms.</li>
                    <li>Content comments: commenting services allow Users to formulate and make public their comments regarding the content of this Website. Users, depending on the settings decided by the Owner, can also leave comments anonymously. If there is an email among the Personal Data released by the User, this could be used to send notifications of comments regarding the same content. Users are responsible for the content of their comments. In the event that a comment service provided by third parties is installed, it is possible that, even if the Users do not use the comment service, it collects traffic data relating to the pages in which the comment service is installed.</li>
                    <li>Mailing list or newsletter (this Website): by registering with the mailing list or newsletter, the User's email address is automatically added to a list of contacts to which email messages containing information, including commercial and promotional, related to this Website. Your email address may also be added to this list as a result of registering on this Website or after making a purchase. Personal Data collected: email; first name.</li>
                    <li>Contact management and sending messages: this type of service allows you to manage a database of email contacts, telephone contacts or contacts of any other type, used to communicate with the User. These services may also allow the collection of data relating to the date and time the messages are displayed by the User, as well as the User's interaction with them, such as information on clicks on links inserted in messages.</li>
                    <li>Payment management: payment management services allow this Website to process payments by credit card, bank transfer or other tools. The data used for payment are acquired directly by the manager of the payment service requested without being processed in any way by this Website. Some of these services may also allow the scheduled sending of messages to the User, such as emails containing invoices or notifications. regarding payment.</li>
                <li>Management of support and contact requests: this type of service allows this Website to manage support and contact requests received by email or through other tools, such as the contact form. The Personal Data processed depend on the information provided by the User within the messages and the tool used for communication (for example the email address).</li>
                    <li>Live Chat Platforms: This type of service allows you to interact with live chat platforms, managed by third parties, directly from the pages of this Website. This allows the User to contact the support service of this Website or this Website. Web to contact the User while he is browsing his pages. In the event that an interaction service with live chat platforms is installed, it is possible that, even if the Users do not use the service, it collects Usage Data relating to the pages in which it is installed. Additionally, live chat conversations may be recorded.</li>
                    <li>Interaction with social networks and external platforms: this type of service allows you to make interactions with social networks, or other external platforms, directly from the pages of this Website. The interactions and information acquired from this Website are in any case subject to the User's privacy settings relating to each social network. This type of service may still collect traffic data for the pages where the service is installed, even when Users do not use it. It is recommended to log out of the respective services to make sure that the data processed on this Website is not connected back to the User's profile.</li>
                    <li>Advertising: This type of service allows the User Data to be used for commercial communication purposes in various forms of advertising, such as banners, also in relation to the User's interests. This does not mean that all Personal Data is used for this purpose. Data and conditions of use are indicated below. Some of these services may use cookies to identify the user or use the behavioral retargeting technique, that is, display advertisements tailored to the interests and behavior of the user, also detected outside this website. For more information in this regard, we suggest you check the privacy policies of the respective services. The User can opt out of the use of cookies by a third party service for some advertising features by visiting the opt-out page of the Network Advertising Initiative. Users can also choose not to participate in certain advertising features through the corresponding device configuration options, such as the mobile device advertising configuration options or the generic advertising configuration.</li>
                    <li>Remarketing e behavioral targeting: This type of service allows this Website and its partners to communicate, optimize and serve advertisements based on the past use of this Website by the User. This activity is carried out through the tracking of Usage Data and the use of Cookies, information that is transferred to the partners to whom the remarketing and behavioral targeting activity is connected. Some services offer a remarketing option based on email address lists. In addition to the possibility of opting out, the User can opt for the exclusion of the use of cookies by a third party service for some remarketing functions by visiting the opt-out page of the Network Advertising Initiative. Users can also choose not to participate in certain advertising features through the corresponding device configuration options, such as the mobile device advertising configuration options or the generic advertising configuration.</li>
                    <li>Statistics: The services contained in this section allow the Data Controller to monitor and analyze traffic data and are used to keep track of User behavior.</li>
                    <li>Viewing content from external platforms: this type of service allows you to view content hosted on external platforms directly from the pages of this Website and interact with them. In the event that a service of this type is installed, it is possible that, even if the Users do not use the service, it collects traffic data relating to the pages in which it is installed.</li>
                    <li>Sale of goods and services online: the Personal Data collected are used for the provision of services to the User or for the sale of products, including payment and possible delivery. The Personal Data collected to complete the payment may be those relating to the credit card, the current account used for the transfer or other payment instruments provided. The payment data collected by this website depend on the payment system used.</li>
                </ul>        
                        
                <h5>User rights</h5>
                            
                Users can exercise certain rights with reference to the Data processed by the Data Controller.
                In particular, the User has the right to:
                            
                withdraw consent at any time: the User can revoke the consent to the processing of their Personal Data previously expressed;
                oppose the processing of their data: the user can oppose the processing of their data when it occurs on a legal basis other than consent. Further details on the right to object are indicated in the section below;
                access their data: the User has the right to obtain information on the Data processed by the Data Controller, on certain aspects of the processing and to receive a copy of the Data processed;
                verify and request rectification: The User can verify the correctness of their Data and request its updating or correction;
                obtain the limitation of the treatment: When certain conditions are met, the User may request the limitation of the processing of their Data. In this case, the Data Controller will not process the Data for any other purpose than their conservation;
                obtain the cancellation or removal of their Personal Data: When certain conditions are met, the User can request the cancellation of their Data by the Owner;
                receive their data or have them transferred to another owner: The User has the right to receive his / her Data in a structured format, commonly used and readable by an automatic device and, where technically feasible, to obtain its unhindered transfer to another owner. This provision is applicable when the Data is processed with automated tools and the processing is based on the User's consent, on a contract to which the User is a party or on contractual measures connected to it;
                propose a complaint: the User can lodge a complaint with the competent personal data protection supervisory authority or take legal action.
                                        
                <h5>Details on the right to object</h5>
                When Personal Data are processed in the public interest, in the exercise of public authority vested in the Owner or to pursue a legitimate interest of the Owner, Users have the right to object to the processing for reasons related to their particular situation.
                Users are reminded that, if their Data are processed for direct marketing purposes, they can oppose the processing without providing any reasons. To find out if the Data Controller processes data for direct marketing purposes, Users can refer to the respective sections of this document.
                
                            
                <h5>How to exercise your rights</h5>
                To exercise the User's rights, Users can direct a request to the contact details of the Owner indicated in this document. Requests are filed free of charge and processed by the Data Controller as soon as possible, in any case within one month.
                                
                <h5>Cookie Policy</h5>
                This website uses cookies. To learn more and to read the detailed information, the User can consult the Cookie Policy.
                        
                            
                <h4>Further information on the treatment</h4>
                            
                <h5>Defense in court</h5>
                The User's Personal Data may be used by the Owner in court or in the preparatory stages for its eventual establishment for the defense against abuse in the use of this Website or related Services by the User.
                The User declares to be aware that the Owner may be obliged to disclose the Data by order of the public authorities.
                
                <h5>Specific information</h5>
                At the request of the User, in addition to the information contained in this privacy policy, this Website may provide the User with additional and contextual information regarding specific Services, or the collection and processing of Personal Data.
                
                <h5>System log and maintenance</h5>
                For needs related to operation and maintenance, this Website and any third party services used by it may collect system logs, which are files that record the interactions and which may also contain Personal Data, such as the User IP address.
                
                <h5>Information not contained in this policy</h5>
                Further information in relation to the processing of Personal Data may be requested at any time from the Data Controller using the contact details.
                
                <h5>Response to "Do Not Track" requests</h5>
                This Website does not support "Do Not Track" requests.
                To find out if any third-party services used support them, the User is invited to consult the respective privacy policies.
                
                <h5>Changes to this privacy policy</h5>
                The Data Controller reserves the right to make changes to this privacy policy at any time by informing Users on this page and, if possible, on this Website as well as, if technically and legally feasible, by sending a notification to Users through one of the contact details held by the Data Controller. Please therefore consult this page regularly, referring to the date of the last modification indicated at the bottom.
                If the changes concern treatments whose legal basis is consent, the Data Controller will collect the User's consent again, if necessary.
                
                <h5>Personal Data (or Data)</h5>
                Any information that, directly or indirectly, also in connection with any other information, including a personal identification number, makes a natural person identified or identifiable constitutes personal data.
                
                <h5>Usage Data</h5>
                This is the information collected automatically through this Website (including from third-party applications integrated into this Website), including: the IP addresses or domain names of the computers used by the User who connects with this Website, the addresses in URI (Uniform Resource Identifier) ​​notation, the time of the request, the method used to forward the request to the server, the size of the file obtained in response, the numerical code indicating the status of the response from the server (successful, error, etc. .) the country of origin, the characteristics of the browser and operating system used by the visitor, the various temporal connotations of the visit (for example the time spent on each page) and the details of the itinerary followed within the Application, with particular reference to the sequence of the pages consulted, to the parameters relating to the operating system and the IT environment of the User.
                
                <h5>User</h5>
                The individual using this Website who, unless otherwise specified, coincides with the Data Subject.
                
                <h5>Interested</h5>
                The natural person to whom the Personal Data refers.
                
                <h5>Data Processor (or Manager)</h5>
                The natural person, legal person, public administration and any other body that processes personal data on behalf of the Data Controller, as set out in this privacy policy.
                
                <h5>Data Controller (or Owner)</h5>
                The natural or legal person, public authority, service or other body which, individually or together with others, determines the purposes and means of the processing of personal data and the tools adopted, including the security measures relating to the operation and use of this Website. The Data Controller, unless otherwise specified, is the owner of this Website.
                
                <h5>This Website (or this Application)</h5>
                The hardware or software tool through which the Personal Data of Users are collected and processed.
                
                <h5>Service</h5>
                The Service provided by this Website as defined in the relative terms (if any) on this site / application.
                
                <h5>European Union (or EU)</h5>
                Unless otherwise specified, any reference to the European Union contained in this document is intended to be extended to all current member states of the European Union and the European Economic Area.
                
                <h5>Cookies</h5>
                Small piece of data stored in the User's device.
                
                <h5>Legal references</h5>
                
                            
                This privacy statement is drawn up on the basis of multiple legislative systems, including articles. 13 and 14 of Regulation (EU) 2016/679.
                
                Unless otherwise specified, this privacy policy applies exclusively to this Website.
                
                
                
                
                <br><br><strong>Last modified: September 20, 2021</strong>
            </p>
        </div>
    </main>

    <?php include 'partials/footer.php';?>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>