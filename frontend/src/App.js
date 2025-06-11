import React, { useState } from 'react';
import 'bootstrap/dist/css/bootstrap.min.css';
import ReviewManager from './components/review/ReviewManager';

function App() {
  const [showReviews, setShowReviews] = useState(false);

  const handleToggle = () => {
    setShowReviews(!showReviews);
  };

  return (
    <div className="container mt-5">
      <h2 className="mb-4">الرئيسية</h2>

      <button className="btn btn-primary" onClick={handleToggle}>
        {showReviews ? 'إخفاء المراجعات' : 'عرض المراجعات'}
      </button>

      {showReviews && (
        <div className="mt-4">
          <ReviewManager />
        </div>
      )}
    </div>
  );
}

export default App;