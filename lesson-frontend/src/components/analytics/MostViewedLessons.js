import React from 'react';

const mostViewedLessons = [
  { id: 1, title: 'Intro to Math', views: 120 },
  { id: 2, title: 'Basic Physics', views: 98 },
  { id: 3, title: 'Organic Chemistry', views: 87 },
  { id: 4, title: 'Programming Fundamentals', views: 76 }
];

function MostViewedLessons() {
  return (
    <div style={{ marginTop: '20px', overflowX: 'auto' }}>
      <h3 style={{ color: '#3a8ee6' }}>Most Viewed Lessons</h3>
      <table style={{
        width: '100%',
        minWidth: '350px',  // ✅ حتى لا ينكسر الجدول بالجوال
        borderCollapse: 'collapse'
      }}>
        <thead>
          <tr style={{ backgroundColor: '#e6f0ff' }}>
            <th style={{ padding: '10px', border: '1px solid #ccc', textAlign: 'left' }}>Lesson</th>
            <th style={{ padding: '10px', border: '1px solid #ccc', textAlign: 'left' }}>Views</th>
          </tr>
        </thead>
        <tbody>
          {mostViewedLessons.map(lesson => (
            <tr key={lesson.id}>
              <td style={{ padding: '10px', border: '1px solid #ccc' }}>{lesson.title}</td>
              <td style={{ padding: '10px', border: '1px solid #ccc' }}>{lesson.views}</td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
}

export default MostViewedLessons;
