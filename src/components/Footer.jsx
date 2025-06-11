import React from 'react';
import { FaTwitter, FaInstagram, FaFacebook } from 'react-icons/fa';

export default function Footer() {
  return (
    <footer className="bg-light py-5">
      <div className="container">
        <div className="row">
          <div className="col-md-4 mb-4 mb-md-0">
            <ul className="list-unstyled">
              <li><a href="#" className="text-decoration-none text-dark">Web Programming</a></li>
              <li><a href="#" className="text-decoration-none text-dark">Mobile Programming</a></li>
              <li><a href="#" className="text-decoration-none text-dark">Java Beginner</a></li>
              <li><a href="#" className="text-decoration-none text-dark">PHP Beginner</a></li>
            </ul>
          </div>
          <div className="col-md-4 mb-4 mb-md-0">
            <ul className="list-unstyled">
              <li><a href="#" className="text-decoration-none text-dark">Adobe Illustrator</a></li>
              <li><a href="#" className="text-decoration-none text-dark">Adobe Photoshop</a></li>
              <li><a href="#" className="text-decoration-none text-dark">Design Logo</a></li>
            </ul>
          </div>
          <div className="col-md-4">
            <ul className="list-unstyled">
              <li><a href="#" className="text-decoration-none text-dark">Writing Course</a></li>
              <li><a href="#" className="text-decoration-none text-dark">Photography</a></li>
              <li><a href="#" className="text-decoration-none text-dark">Video Making</a></li>
            </ul>
          </div>
        </div>
        <div className="d-flex justify-content-center mt-4">
          <a href="#" className="text-dark mx-2"><FaTwitter size={20} /></a>
          <a href="#" className="text-dark mx-2"><FaInstagram size={20} /></a>
          <a href="#" className="text-dark mx-2"><FaFacebook size={20} /></a>
        </div>
      </div>
    </footer>
  );
}