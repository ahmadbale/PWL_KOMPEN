<style>

    .login-container {
    
      background: #F1F3FC;
    
      display: flex;
    
      flex-direction: column;
    
      overflow: hidden;
    
      align-items: center;
    
      font-family: DM Sans, sans-serif;
    
      justify-content: center;
    
      padding: 200px 80px;
    
    }
    
    
    .content-wrapper {
    
      display: flex;
    
      width: 100%;
    
      max-width: 1447px;
    
      flex-direction: column;
    
    }
    
    
    .main-title {
    
      color: #000;
    
      font-size: 100px;
    
      font-weight: 700;
    
      text-align: center;
    
      align-self: center;
    
    }
    
    
    .login-box {
    
      border-radius: 15px;
    
      background: #FFF;
    
      display: flex;
    
      margin-top: 154px;
    
      flex-direction: column;
    
      color: #1D242E;
    
      padding: 87px 0 55px;
    
    }
    
    
    .login-subtitle {
    
      font-size: 36px;
    
      font-weight: 700;
    
      align-self: center;
    
    }
    
    
    .form-container {
    
      display: flex;
    
      margin-top: 91px;
    
      width: 100%;
    
      flex-direction: column;
    
      font-size: 24px;
    
      font-weight: 400;
    
      white-space: nowrap;
    
      padding: 0 70px;
    
    }
    
    
    .input-group {
    
      display: flex;
    
      gap: 40px 100px;
    
      line-height: 1;
    
      flex-wrap: wrap;
    
    }
    
    
    .input-field {
    
      border-radius: 4px;
      background: #E3EBF3;
      border: 1px solid #1D242E;
      margin-left: 60px;
      width: 80%;
      max-width: 100%;
      height: 54px;
    }
    
    
    .submit-btn {
    
      border-radius: 15px;
    
      background: #FFF;
    
      align-self: end;
    
      margin-top: 73px;

      margin-right: 90px;
    
      width: 270px;
    
      max-width: 100%;
    
      font-size: 26px;
    
      color: #212C5F;
    
      font-weight: 700;
    
      padding: 20px 20px;
    
      border: 4px solid #212C5F;
    
      cursor: pointer;
    
    }
    
    
    .visually-hidden {
    
      position: relative;
    
      width: 1px;
    
      height: 1px;
        
      padding: 0;
    
      margin-right: -5%
    
      overflow: hidden;
    
      clip: rect(0, 0, 0, 0);
    
      border: 0;
    
    }
    
    
    @media (max-width: 991px) {
    
      .login-container {
    
        padding: 100px 20px;
    
      }
    
      
    
      .content-wrapper {
    
        max-width: 100%;
    
      }
    
      
    
      .main-title {
    
        max-width: 100%;
    
        font-size: 40px;
    
      }
    
      
    
      .login-box {
    
        max-width: 100%;
    
        margin-top: 40px;
    
      }
    
      
    
      .form-container {
    
        max-width: 100%;
    
        margin-top: 40px;
    
        white-space: initial;
    
        padding: 0 20px;
    
      }
    
      
    
      .input-group {
    
        max-width: 100%;
    
        white-space: initial;
    
      }
    
      
    
      .submit-btn {
    
        margin-top: 40px;
    
        white-space: initial;
    
        padding: 20px;
    
      }
    
    }
    
    </style>
    
    
    <section class="login-container">
    
      <div class="content-wrapper">
    
        <h1 class="main-title">KOMPEN JTI</h1>
    
        
    
        <div class="login-box">
    
          <h2 class="login-subtitle">LOGIN TENDIK/DOSEN</h2>
    
          
    
          <form class="form-container">
    
            <div class="input-group">
    
              <label for="username" class="visually-hidden">Username</label>
    
              <input type="text" id="username" class="input-field" aria-label="Username" required>
    
            </div>
    
            <br>
    
            <div class="input-group">
    
              <label for="password" class="visually-hidden">Password</label>
    
              <input type="password" id="password" class="input-field" aria-label="Password" required>
    
            </div>
    
            
    
            <button type="submit" class="submit-btn">Login</button>
    
          </form>
    
        </div>
    
      </div>
    
    </section>