"use client";

import { useState } from "react";
import {
  Sidebar,
  SidebarContent,
  SidebarFooter,
  SidebarGroup,
  SidebarHeader,
  SidebarMenu,
  SidebarMenuButton,
  SidebarMenuItem,
  SidebarProvider,
  SidebarTrigger,
} from "@/components/ui/sidebar";
import { Icons } from "@/components/icons";
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from "@/components/ui/card";
import { Avatar, AvatarFallback, AvatarImage } from "@/components/ui/avatar";

export default function Home() {
  const [isSettingsOpen, setIsSettingsOpen] = useState(false);

  console.log('API Key:', process.env.GOOGLE_GENAI_API_KEY); // Add this line

  return (
    <SidebarProvider>
      <div className="flex h-screen">
        <Sidebar>
          <SidebarHeader>
            <CardTitle>Sintoniza+ Local Pulse</CardTitle>
            <CardDescription>Your source for local content.</CardDescription>
          </SidebarHeader>
          <SidebarContent>
            <SidebarMenu>
              <SidebarMenuItem>
                <SidebarMenuButton href="#" isActive>
                  <Icons.home className="mr-2 h-4 w-4" />
                  <span>Home</span>
                </SidebarMenuButton>
              </SidebarMenuItem>
              <SidebarMenuItem>
                <SidebarMenuButton href="#">
                  <Icons.messageSquare className="mr-2 h-4 w-4" />
                  <span>Radio Stations</span>
                </SidebarMenuButton>
              </SidebarMenuItem>
              <SidebarMenuItem>
                <SidebarMenuButton href="#">
                  <Icons.user className="mr-2 h-4 w-4" />
                  <span>Local Artists</span>
                </SidebarMenuButton>
              </SidebarMenuItem>
              <SidebarMenuItem>
                <SidebarMenuButton href="#">
                  <Icons.shield className="mr-2 h-4 w-4" />
                  <span>Local Promotions</span>
                </SidebarMenuButton>
              </SidebarMenuItem>
              <SidebarMenuItem>
                <SidebarMenuButton href="/submit-artist">
                  <Icons.plusCircle className="mr-2 h-4 w-4" />
                  <span>Submit Artist</span>
                </SidebarMenuButton>
              </SidebarMenuItem>
            </SidebarMenu>
          </SidebarContent>
          <SidebarFooter>
            <div className="flex items-center justify-between p-2">
              <Avatar className="h-8 w-8">
                <AvatarImage src="https://picsum.photos/seed/m7/200/200" alt="Avatar" />
                <AvatarFallback>M7</AvatarFallback>
              </Avatar>
              <SidebarTrigger className="ml-auto" />
            </div>
          </SidebarFooter>
        </Sidebar>
        <div className="flex-1 p-4">
          <Card>
            <CardHeader>
              <CardTitle>Welcome to Sintoniza+ Local Pulse</CardTitle>
              <CardDescription>Explore local radio, artists, and promotions.</CardDescription>
            </CardHeader>
            <CardContent className="flex flex-col gap-4">
              <p>This is a NextJS starter in Firebase Studio.</p>
              <p>To get started, take a look at src/app/page.tsx.</p>
            </CardContent>
          </Card>
        </div>
      </div>
    </SidebarProvider>
  );
}


