import React from 'react';

function NotificationItem({ notification, onMarkAsRead }) {
  const containerStyle = {
    backgroundColor: notification.isRead ? '#f5f5f5' : '#e6f0ff',
    padding: '12px',
    marginBottom: '10px',
    borderRadius: '8px',
    boxShadow: '0 1px 3px rgba(0,0,0,0.1)',
    cursor: 'pointer',
    display: 'flex',
    flexDirection: 'column'
  };

  const timeStyle = {
    fontSize: '12px',
    color: '#555',
    marginTop: '6px',
    alignSelf: 'flex-end'
  };

  return (
    <div style={containerStyle} onClick={() => onMarkAsRead(notification.id)}>
      <div style={{ fontSize: '14px', lineHeight: '1.6' }}>
        {notification.message}
      </div>
      <div style={timeStyle}>
        {notification.timeAgo} {/* مثل: 2m، 3h، 1d */}
      </div>
    </div>
  );
}

export default NotificationItem;

