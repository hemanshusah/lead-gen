# --- Base Image: Use the official lightweight Node.js Alpine image ---
# Alpine Linux is a minimal Docker image based on Alpine Linux, which is much smaller than other distribution base images.
FROM node:20-alpine

# --- System Dependencies for Playwright ---
# Alpine is very minimal, so we need to manually install all the system-level
# dependencies that the Playwright browser (Chromium) needs to run.
# This is the key to making Playwright work on Alpine.
RUN apk add --no-cache \
      chromium \
      nss \
      freetype \
      harfbuzz \
      ca-certificates \
      ttf-freefont \
      udev \
      xvfb

# --- Environment Variables ---
# Set the working directory inside the container
WORKDIR /usr/src/app

# Tell Playwright to use the Chromium browser we installed via apk
ENV PLAYWRIGHT_BROWSERS_PATH=/usr/bin

# --- Copy Files & Install Dependencies ---
# This part remains the same. It leverages Docker caching for faster builds.
COPY package*.json ./
RUN npm install

# Copy the rest of the application source code
COPY . .

# --- Expose Port ---
EXPOSE 3000

# --- Startup Command ---
CMD ["npm", "start"]
