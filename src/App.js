// src/App.js
import { BrowserRouter as Router, Routes, Route, Navigate } from "react-router-dom";
import FreePage from "./components/FreePage";
import PaidCoursesPage from "./components/PaidCoursesPage";

function App() {
  return (
    <Router>
      <Routes>
        <Route path="/" element={<Navigate to="/free-courses" replace />} />
        <Route path="/free-courses" element={<FreePage />} />
        <Route path="/paid-courses" element={<PaidCoursesPage />} />
      </Routes>
    </Router>
  );
}

export default App;
