<div id="top"></div>

<!-- PROJECT LOGO -->
<br />
<div align="center">
  <a href="https://github.com/AudricSan/Photographics/">
    <img src="public/images/logo2.png" alt="Logo">
  </a>

<h3 align="center">Photographics</h3>
  <p align="justify">
Photographics is a free and open source project for photographers who want to swiftly submit their photos to the internet. This project seeks to make managing your photographs as simple and quick as possible.
It gives the photographer total control over his images by allowing him to tag and share them.
Photographics is an open source project that is completely free!
A site where you may save all of your images in one location.
<br />

  <p align="center">
    <a href="https://github.com/AudricSan/Photographics"><strong>Explore the docs »</strong></a>
    <br />
    <br />
    <a href="http://photo.audricrosier.be">View Demo</a>
    ·
    <a href="https://github.com/AudricSan/Photographics/issues">Report Bug</a>
    ·
    <a href="https://github.com/AudricSan/Photographics/issues">Request Feature</a>
  </p>
</div>

<!-- TABLE OF CONTENTS -->
<details>
  <summary>Table of Contents</summary>
  <ol>
    <li>
      <a href="#about-the-project">About The Project</a>
      <ul>
        <li><a href="#built-with">Built With</a></li>
      </ul>
    </li>
    <li>
      <a href="#getting-started">Getting Started</a>
      <ul>
        <li><a href="#prerequisites">Prerequisites</a></li>
        <li><a href="#installation">Installation</a></li>
      </ul>
    </li>
    <li><a href="#usage">Usage</a></li>
    <li><a href="#roadmap">Roadmap</a></li>
    <li><a href="#contributing">Contributing</a></li>
    <li><a href="#license">License</a></li>
    <li><a href="#contact">Contact</a></li>
    <li><a href="#acknowledgments">Acknowledgments</a></li>
  </ol>
</details>

<!-- ABOUT THE PROJECT -->
## About The Project
[![Product Name Screen Shot][product-logo]](http://photo.audricrosier.be)

### Built With
* [PHP](https://php.net/)
* [JavaScript](https://www.javascript.com/)
* [HTML](https://html.com/)
* [CSS](https://developer.mozilla.org/fr/docs/Web/CSS)
* [SCSS](https://sass-lang.com/)

<!-- GETTING STARTED -->
## Getting Started
This is an example of how you can give instructions on setting up your project locally or online.
To set up a local copy and get it running, follow the steps below.

### Prerequisites
It is a list of the elements necessary to use the software and to install them.
* 
  ```sh
  php 7.4
  MYSQL v.5.6
  ```

### Installation
1. Install Wamp local sever.
   ```sh
   https://www.wampserver.com/
   ```
1. Clone the repo.
   ```sh
   git clone https://github.com/AudricSan/Photographics.git
   ```
1. Put photographics in Wamp www folder.
   ```sh
   C:\wamp64\www\[PHOTOGRAPHICS FOLDER]
   ```
1. Create a Vhost in Wamp to use Photographics.

1. Create the Database in PHP my admin
   ```sh
   [PHOTOGRAPHICS FOLDER]\model\sql\db.sql
   ```

1. Edit Env.php with your Database info
   ```sh
   [PHOTOGRAPHICS FOLDER]\model\class\env.php
   ```
   ```php
   private $env = [
      //APP
      'APP_NAME' => 'photographics',
      'APP_KEY' => '',  
      //DATABASE
      'DB_HOST' => 'localhost',
      'DB_USERNAME' => 'root',
      'DB_PASSWORD' => 'root',
      'DB_NAME' => 'photographics',
      'DB_PORT' => 3306
   ];
   ```
1. You can now Connect to the Admin platform
   ```sh
   [YOUR VHOST LINK]/admin
   ```
   ```sh
   Login: admin
   password: password
   ```
1. Add a new admin and Remove de Default Admin

<!-- USAGE -->
## Usage
This project was designed so that the photographer's cache can with a minimum of knowledge easily host his photos online via a turnkey website!

<div align="center">
    <p>these person uses the project !</p>
	<img src="/public/docs/images/audricsan.png" width="100" height="100" alt="friends">
</div>

_For more info, please refer to the [Documentation](https://github.com/AudricSan/Photographics/tree/main/public/docs/)

<!-- ROADMAP -->
## Roadmap
- [ ] Mutliple Tag by Picture
- [ ] hyrarchy of the administrator role
- [ ] send several pictures at the same time.
- [ ] Drop down menu for the different tags from the gallery on public side.
- [ ] Display per tag in Picture Dashboard.
- [ ] Modify the metas of the site.
- [ ] Change the 'colors' of the site.
- [ ] Connect to an API (Instagram, Tumbler).

  ## Known Bug
    - [ ] 

See the [open issues](https://github.com/AudricSan/Photographics/issues) for a full list of proposed features (and known issues).

<!-- CONTRIBUTING -->
## Contributing
Contributions are what make the open source community such a great place to learn, be inspired and create. All your contributions are **greatly appreciated**.

If you have a suggestion that would improve this product, please open the repository and create a change request. You can also simply open an issue with the label "suggestion".
Don't forget to give the project a star! Thanks again!

1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the Branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

<!-- LICENSE -->
## License
Distributed under the  AGPL-3.0 License. See `LICENSE.txt` for more information.

<!-- CONTACT -->
## Contact
[Twitter -> @AudricSan](https://twitter.com/AudricSan)<br>
[Email](mailto:audricrosier@gmail.com)

Project Link: [Photographics](https://github.com/AudricSan/Photographics)

<!-- ACKNOWLEDGMENTS -->
## Acknowledgments
* [@Thepyrocrafteur - Github](https://github.com/Thepyrocrafteur)
* [@Thepyrocrafteur - Gitlab](https://gitlab.com/Thepyrocrafteur)
* [@Uranium - Gitlab](https://gitlab.com/Uranium49)

[product-screenshot]: public/images/logo2.png
[product-logo]: public/images/logo.png
