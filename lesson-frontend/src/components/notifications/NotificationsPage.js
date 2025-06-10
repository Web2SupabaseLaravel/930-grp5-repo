import React, { useState, useEffect } from 'react';
import NotificationList from './NotificationList';
import mockNotifications from './mockNotifications';

function NotificationsPage() {
  const [notifications, setNotifications] = useState(mockNotifications);
  const [boxStyle, setBoxStyle] = useState({});

  const markAsRead = (id) => {
    const updated = notifications.map(n =>
      n.id === id ? { ...n, isRead: true } : n
    );
    setNotifications(updated);
  };

  const markAllAsRead = () => {
    const updated = notifications.map(n => ({ ...n, isRead: true }));
    setNotifications(updated);
  };

  // ✅ تحديث التنسيق حسب حجم الشاشة
  useEffect(() => {
    const handleResize = () => {
      const screenWidth = window.innerWidth;

      if (screenWidth <= 480) {
        // جوال
        setBoxStyle({
          width: '90%',
          right: '5%',
          top: '60px'
        });
      } else if (screenWidth <= 768) {
        // تابلت
        setBoxStyle({
          width: '400px',
          right: '10px',
          top: '60px'
        });
      } else {
        // لابتوب
        setBoxStyle({
          width: '380px',
          right: '20px',
          top: '60px'
        });
      }
    };

    handleResize(); // أول مرة
    window.addEventListener('resize', handleResize); // عند تغيير الحجم

    return () => window.removeEventListener('resize', handleResize);
  }, []);

  return (
    <div style={{ position: 'relative' }}>
      <div style={{
        position: 'absolute',
        ...boxStyle, // ✅ متغير حسب الشاشة
        backgroundColor: '#fff',
        padding: '20px',
        borderRadius: '8px',
        boxShadow: '0 2px 10px rgba(0,0,0,0.2)',
        zIndex: 999
      }}>
        <h2 style={{ marginBottom: '16px' }}>Notifications</h2>

        <NotificationList
          notifications={notifications}
          onMarkAsRead={markAsRead}
        />

        <div style={{ display: 'flex', justifyContent: 'space-between', marginTop: '20px' }}>
          <button
            onClick={() => alert("Navigate to full notifications page (optional)")}
            style={{
              background: 'none',
              border: 'none',
              color: '#0077cc',
              cursor: 'pointer',
              textDecoration: 'underline'
            }}
          >
            View all notifications
          </button>

          <button
            onClick={markAllAsRead}
            style={{
              background: 'none',
              border: 'none',
              color: '#0077cc',
              cursor: 'pointer',
              textDecoration: 'underline'
            }}
          >
            Mark all read
          </button>
        </div>
      </div>
    </div>
  );
}

export default NotificationsPage;
