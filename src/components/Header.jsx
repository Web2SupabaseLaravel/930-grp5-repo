import { FaSearch, FaShoppingCart } from "react-icons/fa";

export default function Header() {
  return (
    <nav className="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-3">
      <div className="container">
        <a className="navbar-brand" href="#">
          <img src="/logo.png" alt="Learnify Logo" height="30" />
        </a>

        <div className="d-flex flex-grow-1 mx-lg-5">
          <div className="input-group">
            <input type="text" className="form-control bg-light" placeholder="Search for course" />
            <button className="btn btn-outline-secondary" type="button">
              <FaSearch />
            </button>
          </div>
        </div>

        <div className="d-flex align-items-center gap-3">
          <a href="#" className="text-dark text-decoration-none">Become Instructor</a>
          <button className="btn btn-link text-dark p-0">
            <FaShoppingCart size={20} />
          </button>
          <button className="btn btn-outline-dark mx-2">Login</button>
          <button className="btn btn-primary">Sign Up</button>
        </div>
      </div>
    </nav>
  );
}
