function Sidebar() {
  return (
    <div className="bg-primary text-white vh-100 p-3" style={{ width: '220px' }}>
      <h5 className="mb-4">Dashboard</h5>
      <ul className="list-unstyled">
        <li className="mb-3"><a href="#" className="text-white text-decoration-none">Home</a></li>
        <li><a href="#" className="text-white text-decoration-none">My Courses</a></li>
      </ul>
    </div>
  );
}

export default Sidebar;
