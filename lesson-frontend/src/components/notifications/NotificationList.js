import React from 'react';
import NotificationItem from './NotificationItem';

function NotificationList({ notifications, onMarkAsRead }) {
  return (
    <div>
      {notifications.map((notification) => (
        <NotificationItem
          key={notification.id}
          notification={notification}
          onMarkAsRead={onMarkAsRead}
        />
      ))}
    </div>
  );
}

export default NotificationList;
