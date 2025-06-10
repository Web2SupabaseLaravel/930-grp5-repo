import React, { useState } from 'react';
import {
  BrowserRouter as Router,
  Routes,
  Route,
  Link,
  useLocation,
  useNavigate
} from 'react-router-dom';

import { FiBell, FiBarChart2 } from 'react-icons/fi';

import NotificationsPage from './components/notifications/NotificationsPage';
import AnalyticsDashboard from './components/analytics/AnalyticsDashboard';
import LessonManager from './components/lessons/LessonManager';
import AddLesson from './components/lessons/AddLesson';
import EditLesson from './components/lessons/EditLesson'; // ✅ استيراد صفحة التعديل
import mockNotifications from './components/notifications/mockNotifications';

function AppLayout() {
  const location = useLocation();
  const navigate = useNavigate();
  const [notifications] = useState(mockNotifications);
  const unreadCount = notifications.filter(n => !n.isRead).length;

  const iconStyle = (path) => ({
    fontSize: '22px',
    color: location.pathname === path ? '#3a8ee6' : '#000',
    textDecoration: 'none',
    position: 'relative'
  });

  return (
    <div>
      {/* ✅ Top Navbar */}
      <div style={{
        display: 'flex',
        justifyContent: 'space-between',
        alignItems: 'center',
        backgroundColor: '#f9f9f9',
        padding: '10px 20px',
        borderBottom: '1px solid #ccc'
      }}>
        <div><strong>Learnify</strong></div>

        <div style={{ display: 'flex', gap: '20px', alignItems: 'center' }}>
          <Link to="/notifications" style={iconStyle('/notifications')}>
            <FiBell />
            {unreadCount > 0 && (
              <span style={{
                position: 'absolute',
                top: '-6px',
                right: '-6px',
                backgroundColor: '#3a8ee6',
                color: 'white',
                fontSize: '10px',
                borderRadius: '50%',
                padding: '2px 6px',
                fontWeight: 'bold'
              }}>
                {unreadCount}
              </span>
            )}
          </Link>

          <Link to="/analytics" style={iconStyle('/analytics')}>
            <FiBarChart2 />
          </Link>

          <Link to="/lessons" style={iconStyle('/lessons')}>
            📚
          </Link>
        </div>
      </div>

      {/* ✅ Routes */}
      <Routes>
        <Route path="/notifications" element={<NotificationsPage />} />
        <Route path="/analytics" element={<AnalyticsDashboard />} />
        <Route path="/lessons" element={<LessonManager />} />
        <Route path="/lessons/add" element={<AddLesson />} />
        <Route path="/lessons/edit/:id" element={<EditLesson />} /> {/* ✅ مسار التعديل */}
      </Routes>
    </div>
  );
}

function App() {
  return (
    <Router>
      <AppLayout />
    </Router>
  );
}

export default App;
