# Stage 1: Build the React application
FROM node:22-alpine AS builder
WORKDIR /app

# Copy lock files and install dependencies
COPY package*.json ./
RUN npm install

# Copy the rest of the application code
COPY . .

# Build the application (Generates 'dist' for Vite or 'build' for CRA)
RUN npm run build

# Stage 2: Serve the application using Nginx
FROM nginx:1.27-alpine

# Copy the build output to Nginx's default public directory
# NOTE: Change "dist" to "build" if using older Create React App (CRA)
COPY --from=builder /app/dist /usr/share/nginx/html

# Copy custom Nginx configuration if you have client-side routing
# COPY nginx.conf /etc/nginx/conf.d/default.conf

EXPOSE 80

CMD ["nginx", "-g", "daemon off;"]