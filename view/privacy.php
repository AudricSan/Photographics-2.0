<main>
    <div class='privacy'>
        <?php

        $root = (isset($_SESSION['root'])) ? $_SESSION['root'] : NULL;
        $name = (isset($_SESSION['basicinfo']['Photographer Name'])) ? $_SESSION['basicinfo']['Photographer Name'] : NULL;
        $mail = (isset($_SESSION['basicinfo']['Photographer Mail'])) ? $_SESSION['basicinfo']['Photographer Mail'] : NULL;


        echo "
        <h1>Privacy Policy for photographics Used by $name</h1>
        <p>
            At Photographics, accessible from $root, one of our main priorities is the privacy of our visitors. This Privacy
            Policy document contains types of information that is collected and recorded by Photographics and how we use it.
        </p>

        <p> If you have additional questions or require more information about our Privacy Policy, do not hesitate to contact us. </p>

        <p>This Privacy Policy applies only to our online activities and is valid for visitors to our website with regards to
            the information that they shared and/or collect in Photographics. This policy is not applicable to any information
            collected offline or via channels other than this website.
        </p>

        <h2>Contact</h2>
        <p>contact email : $mail</p>
        
        <h2>Consent</h2>
        <p>By using our website, you hereby consent to our Privacy Policy and agree to its terms.</p>

        <h2>Information we collect</h2>
        <p>
            The personal information that you are asked to provide, and the reasons why you are asked to provide it, will be made
            clear to you at the point we ask you to provide your personal information.</p>
        <p>
            If you contact us directly, we may receive additional information about you such as your name, email address, phone
            number, the contents of the message and/or attachments you may send us, and any other information you may choose to
            provide.</p>

        <p>
            When you register for an Account, we may ask for your contact information, including items such as name, company
            name, address, email address, and telephone number.</p>

        <h2>How we use your information</h2>
        <p>We use the information we collect in various ways, including to:</p>

        <ul>
            <li>Provide, operate, and maintain our website</li>
            <li>Improve, personalize, and expand our website</li>
            <li>Understand and analyze how you use our website</li>
            <li>Develop new products, services, features, and functionality</li>
            <li>Communicate with you, either directly or through one of our partners, including for customer service, to provide
                you with updates and other information relating to the website, and for marketing and promotional purposes</li>
            <li>Send you emails</li>
            <li>Find and prevent fraud</li>
        </ul>

        <h2>Log Files</h2>
        <p>Photographics follows a standard procedure of using log files. These files log visitors when they visit websites. All
            hosting companies do this and a part of hosting services' analytics. The information collected by log files include
            internet protocol (IP) addresses, browser type, Internet Service Provider (ISP), date and time stamp, referring/exit
            pages, and possibly the number of clicks. These are not linked to any information that is personally identifiable.
            The purpose of the information is for analyzing trends, administering the site, tracking users' movement on the
            website, and gathering demographic information.</p>

        <h2>Cookies and Web Beacons</h2>
        <p>A cookie is a text file deposited on the hard disk of your computer, your mobile device or your tablet when you visit
            a site or consult an advertisement. Its purpose is to collect information about your browsing and to send you
            services adapted to your terminal.
            The cookie contains a unique code that allows your browser to be recognized during your visit to the website or
            during future repeated visits. Cookies may be placed by the server of the website you are visiting or by partners
            with whom that website collaborates. A website's server can only read the cookies it has set and has no access to
            any other information on your computer or mobile device. Cookies ensure a generally easier and faster interaction
            between the visitor and the website. In fact, they remember your preferences (the language you choose or a reading
            format, for example) and thus allow you to speed up your subsequent access to the site and facilitate your visits.
            In addition, they help you navigate between different parts of the website. Cookies can also be used to make website
            content or advertising more relevant to the visitor's personal choices, tastes and needs.
            The information collected is anonymous and does not identify you as an individual. Indeed, the information linked to
            cookies cannot be associated with a name and/or surname because it does not contain any personal data. Cookies are
            managed by your Internet browser. The use of cookies requires your prior and explicit consent. You can always come
            back later on and refuse these cookies and/or delete them at any time, by modifying the settings of your browser.
        </p>

        <p>Like any other website, Photographics uses 'cookies'. These cookies are used to store information including visitors'
            preferences, and the pages on the website that the visitor accessed or visited. The information is used to optimize
            the users' experience by customizing our web page content based on visitors' browser type and/or other information.
        </p>

        <h2>Allow or block cookies?</h2>
        <p>
            Most web browsers are automatically configured to accept cookies. However, you can configure your browser to accept
            or
            block cookies.
            However, I cannot guarantee that you will be able to access all the services on my website if you refuse to accept
        </p>

        <h2>hosting Service</h2>
        <p>
            OVH
            2 rue Kellermann
            59100 Roubaix - France.
            www.ovh.com</p>

        <h2>Advertising Partners Privacy Policies</h2>
        <P>You may consult this list to find the Privacy Policy for each of the advertising partners of Photographics.</p>
        <p>Third-party ad servers or ad networks uses technologies like cookies, JavaScript, or Web Beacons that are used in
            their respective advertisements and links that appear on Photographics, which are sent directly to users' browser.
            They automatically receive your IP address when this occurs. These technologies are used to measure the
            effectiveness of their advertising campaigns and/or to personalize the advertising content that you see on websites
            that you visit.</p>
        <p>Note that Photographics has no access to or control over these cookies that are used by third-party advertisers.</p>

        <h2>Third Party Privacy Policies</h2>
        <p>Photographics's Privacy Policy does not apply to other advertisers or websites. Thus, we are advising you to consult
            the respective Privacy Policies of these third-party ad servers for more detailed information. It may include their
            practices and instructions about how to opt-out of certain options. </p>
        <p>You can choose to disable cookies through your individual browser options. To know more detailed information about
            cookie management with specific web browsers, it can be found at the browsers' respective websites.</p>

        <h2>CCPA Privacy Rights (Do Not Sell My Personal Information)</h2>
        <p>Under the CCPA, among other rights, California consumers have the right to:</p>
        <p>Request that a business that collects a consumer's personal data disclose the categories and specific pieces of
            personal data that a business has collected about consumers.</p>
        <p>Request that a business delete any personal data about the consumer that a business has collected.</p>
        <p>Request that a business that sells a consumer's personal data, not sell the consumer's personal data.</p>
        <p>If you make a request, we have one month to respond to you. If you would like to exercise any of these rights, please
            contact us.</p>

        <h2>GDPR Data Protection Rights</h2>
        <p>We would like to make sure you are fully aware of all of your data protection rights. Every user is entitled to the
            following:</p>
        <p>The right to access - You have the right to request copies of your personal data. We may charge you a small fee for
            this service.</p>
        <p>The right to rectification - You have the right to request that we correct any information you believe is inaccurate.
            You also have the right to request that we complete the information you believe is incomplete.</p>
        <p>The right to erasure - You have the right to request that we erase your personal data, under certain conditions.</p>
        <p>The right to restrict processing - You have the right to request that we restrict the processing of your personal
            data, under certain conditions.</p>
        <p>The right to object to processing - You have the right to object to our processing of your personal data, under
            certain conditions.</p>
        <p>The right to data portability - You have the right to request that we transfer the data that we have collected to
            another organization, or directly to you, under certain conditions.</p>
        <p>If you make a request, we have one month to respond to you. If you would like to exercise any of these rights, please
            contact us.</p>

        <h2>Children's Information</h2>
        <p>Another part of our priority is adding protection for children while using the internet. We encourage parents and
            guardians to observe, participate in, and/or monitor and guide their online activity.</p>
        <p>Photographics does not knowingly collect any Personal Identifiable Information from children under the age of 13. If
            you think that your child provided this kind of information on our website, we strongly encourage you to contact us
            immediately and we will do our best efforts to promptly remove such information from our records.</p>

        <h2>Trademarks and trade names</h2>
        <p>The denominations, logos and other signs used on my site are trademarks and/or trade names legally protected. Any use
            of these or similar signs is strictly forbidden without prior written consent.
        </p>

        <h2>Responsibility for the content</h2>
        <p>
            I take great care in creating and updating this site, but I cannot guarantee the accuracy of the information it
            contains. The information contained in this site may be subject to change without notice. I cannot be held
            responsible for any omissions, errors or omissions in the pages of this site, nor for the consequences, whatever
            they may be, that may result from the use of the information and indications provided.
        </p>
        </main>
    </main>
";
