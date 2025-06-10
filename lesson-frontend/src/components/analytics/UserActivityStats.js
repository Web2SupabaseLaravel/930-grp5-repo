import React from 'react';

const userStats = {
  logins: 56,
  comments: 34,
  lessonInteractions: 89
};

function UserActivityStats() {
  const cardStyle = {
    backgroundColor: '#e6f0ff',
    borderRadius: '10px',
    padding: '15px',
    margin: '10px',
    flex: '1 1 200px',  // ✅ يجعل العنصر مرنًا ومتجاوبًا
    minWidth: '150px',
    textAlign: 'center',
    boxShadow: '0 1px 3px rgba(0,0,0,0.1)'
  };

  const containerStyle = {
    display: 'flex',
    flexWrap: 'wrap',
    justifyContent: 'center', // ✅ يجعلها بالوسط في الجوال
    gap: '10px',
    marginTop: '20px'
  };

  const titleStyle = {
    color: '#3a8ee6',
    marginBottom: '8px'
  };

  const numberStyle = {
    fontSize: '24px',
    fontWeight: 'bold',
    color: '#3a8ee6'
  };

  return (
    <div style={containerStyle}>
      <div style={cardStyle}>
        <h4 style={titleStyle}>Logins</h4>
        <p style={numberStyle}>{userStats.logins}</p>
      </div>
      <div style={cardStyle}>
        <h4 style={titleStyle}>Comments</h4>
        <p style={numberStyle}>{userStats.comments}</p>
      </div>
      <div style={cardStyle}>
        <h4 style={titleStyle}>Lesson Interactions</h4>
        <p style={numberStyle}>{userStats.lessonInteractions}</p>
      </div>
    </div>
  );
}

export default UserActivityStats;
